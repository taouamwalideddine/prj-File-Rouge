<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Classroom;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizResult;
use App\Models\StudentAnswer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    use AuthorizesRequests;

    protected function currentUser()
    {
        return User::find(Auth::id());
    }

    public function dashboard()
    {
        $student = $this->currentUser();

        return view('student.dashboard', [
            'joinedClassrooms' => $student->joinedClassrooms()->with('teacher')->get(),
            'availableQuizzes' => $student->availableQuizzes()->with('classroom')->get(),
            'recentResults' => $student->quizResults()->with('quiz')->latest()->take(3)->get()
        ]);
    }

    public function classrooms()
    {
        $student = $this->currentUser();

        return view('student.classrooms.index', [
            'joinedClassrooms' => $student->joinedClassrooms()->with('teacher')->get(),
            'availableClassrooms' => Classroom::whereDoesntHave('students', function($query) use ($student) {
                $query->where('user_id', $student->id);
            })->get()
        ]);
    }

    public function showClassroom(Classroom $classroom)
    {
        $this->authorize('view', $classroom);
        $student = $this->currentUser();

        return view('student.classrooms.show', [
            'classroom' => $classroom,
            'quizzes' => $classroom->quizzes()
                ->available()
                ->withCount('questions')
                ->get()
        ]);
    }

    public function joinClassroom(Request $request, Classroom $classroom)
    {
        $student = $this->currentUser();

        if ($student->pendingClassrooms()->where('classroom_id', $classroom->id)->exists()) {
            return back()->with('error', 'You already have a pending request for this class');
        }

        $classroom->students()->attach($student->id, ['status' => 'pending']);

        return back()->with('success', 'Join request sent to teacher');
    }

    public function quizzes()
    {
        $student = $this->currentUser();

        return view('student.quizzes.index', [
            'quizzes' => $student->availableQuizzes()
                ->with(['classroom', 'questions'])
                ->paginate(10)
        ]);
    }

    public function startQuiz(Quiz $quiz)
    {
        $student = $this->currentUser();

        if ($quiz->results()->where('student_id', $student->id)->exists()) {
            abort(403, 'You have already taken this quiz');
        }

        if (!$quiz->isActive()) {
            abort(403, 'This quiz is no longer available');
        }

        return view('student.quizzes.take', [
            'quiz' => $quiz->load(['questions.answers'])
        ]);
    }

    public function submitQuiz(Request $request, Quiz $quiz)
    {
        // check if student has already taken this quiz
        $existingResult = QuizResult::where('quiz_id', $quiz->id)
            ->where('student_id', Auth::id())
            ->first();

        if ($existingResult) {
            return redirect()->route('student.quiz.results', $existingResult)
                ->with('info', 'You have already completed this quiz.');
        }

        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|exists:answers,id'
        ]);

        $score = 0;
        $totalQuestions = $quiz->questions->count();
        $answerDetails = [];

        // calculate scores
        foreach ($quiz->questions as $question) {
            $submittedAnswerId = $request->answers[$question->id] ?? null;

            if ($submittedAnswerId) {
                $submittedAnswer = Answer::find($submittedAnswerId);
                $correctAnswer = $question->answers->where('is_correct', true)->first();

                $isCorrect = $submittedAnswer && $submittedAnswer->is_correct;

                if ($isCorrect) {
                    $score += $question->points;
                }

                // store answer details for review
                $answerDetails[$question->id] = [
                    'answer_id' => $submittedAnswerId,
                    'content' => $submittedAnswer ? $submittedAnswer->content : null,
                    'is_correct' => $isCorrect,
                    'correct_answer_id' => $correctAnswer ? $correctAnswer->id : null
                ];
            }
        }

        // create quiz result
        $result = QuizResult::create([
            'quiz_id' => $quiz->id,
            'student_id' => Auth::id(),
            'score' => $score,
            'total_questions' => $totalQuestions,
            'answer_details' => $answerDetails,
            'completed_at' => now()
        ]);

        return redirect()->route('student.quiz.results', $result)
            ->with('success', 'Quiz completed successfully!');
    }

    protected function validateQuizAccess(User $student, Quiz $quiz)
    {
        if ($quiz->results()->where('student_id', $student->id)->exists()) {
            abort(403, 'You have already taken this quiz');
        }

        if ($quiz->expires_at && $quiz->expires_at->isPast()) {
            abort(403, 'This quiz has expired');
        }
    }

    protected function validateAllQuestionsAnswered(Request $request, Quiz $quiz)
    {
        $answeredQuestionIds = array_keys($request->input('answers', []));
        $allQuestionIds = $quiz->questions->pluck('id')->toArray();
        $unanswered = array_diff($allQuestionIds, $answeredQuestionIds);

        if (!empty($unanswered)) {
            return redirect()->back()
                ->withErrors(['answers' => 'You must answer all questions before submitting.'])
                ->withInput();
        }
    }

    protected function processQuizSubmission(Request $request, Quiz $quiz, User $student)
    {
        DB::beginTransaction();

        try {
            $score = 0;
            $answers = [];

            foreach ($quiz->questions as $question) {
                $answerId = $request->input("answers.{$question->id}");
                $isCorrect = $this->isAnswerCorrect($question, $answerId);

                if ($isCorrect) {
                    $score += $question->points;
                }

                $this->storeStudentAnswer($student, $question, $answerId, $isCorrect);

                $answers[$question->id] = [
                    'answer_id' => $answerId,
                    'is_correct' => $isCorrect,
                    'points' => $isCorrect ? $question->points : 0
                ];
            }

            $result = $this->storeQuizResult($quiz, $student, $score, $answers);

            DB::commit();

            return redirect()->route('student.quiz.results', $result);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors(['error' => 'An error occurred while submitting your quiz. Please try again.']);
        }
    }

    protected function isAnswerCorrect(Question $question, $answerId): bool
    {
        return $question->answers()
            ->where('id', $answerId)
            ->where('is_correct', true)
            ->exists();
    }

    protected function storeStudentAnswer(User $student, Question $question, $answerId, bool $isCorrect)
    {
        return StudentAnswer::create([
            'student_id' => $student->id,
            'question_id' => $question->id,
            'answer_id' => $answerId,
            'is_correct' => $isCorrect
        ]);
    }

    protected function storeQuizResult(Quiz $quiz, User $student, int $score, array $answers)
    {
        return QuizResult::create([
            'quiz_id' => $quiz->id,
            'student_id' => $student->id,
            'score' => $score,
            'total_questions' => $quiz->questions->count(),
            'answer_details' => $answers,
            'completed_at' => now()
        ]);
    }

    public function quizResults(QuizResult $result)
    {
        $student = $this->currentUser();

        if ($result->student_id !== $student->id) {
            abort(403);
        }

        return view('student.quizzes.results', [
            'result' => $result->load(['quiz.questions.answers'])
        ]);
    }
}
