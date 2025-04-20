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
        $student = $this->currentUser();

        if ($quiz->results()->where('student_id', $student->id)->exists()) {
            abort(403, 'Already completed this quiz');
        }

        $score = 0;
        $answers = [];

        foreach ($quiz->questions as $question) {
            $answerId = $request->input('answers.'.$question->id);
            $isCorrect = $question->answers->contains('id', $answerId) &&
                         $question->answers->firstWhere('id', $answerId)->is_correct;

            if ($isCorrect) {
                $score += $question->points;
            }

            StudentAnswer::create([
                'student_id' => $student->id,
                'question_id' => $question->id,
                'answer_id' => $answerId,
                'is_correct' => $isCorrect
            ]);

            $answers[$question->id] = [
                'answer_id' => $answerId,
                'is_correct' => $isCorrect,
                'points' => $isCorrect ? $question->points : 0
            ];
        }

        $result = QuizResult::create([
            'quiz_id' => $quiz->id,
            'student_id' => $student->id,
            'score' => $score,
            'total_questions' => $quiz->questions->count(),
            'answer_details' => $answers,
            'completed_at' => now()
        ]);

        return redirect()->route('student.quiz.results', $result);
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
