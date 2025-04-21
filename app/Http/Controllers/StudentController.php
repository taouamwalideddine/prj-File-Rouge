<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Quiz;
use App\Models\QuizResult;
use App\Models\StudentAnswer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

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
        $student = Auth::user();

        $this->validateQuizAccess($student, $quiz);

        $this->validateAllQuestionsAnswered($request, $quiz);

        return $this->processQuizSubmission($request, $quiz, $student);
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
