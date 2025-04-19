<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Quiz;
use App\Models\QuizResult;
use App\Models\StudentAnswer;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function dashboard()
    {
    }


    public function classrooms()
    {
        return view('student.classrooms.index', [
            'joinedClassrooms' => auth()->user()->enrolledClassrooms()
                                   ->wherePivot('status', 'accepted')
                                   ->with('teacher')
                                   ->get(),
            'availableClassrooms' => Classroom::whereDoesntHave('students', function($q) {
                $q->where('user_id', auth()->id());
            })->get()
        ]);
    }

    public function showClassroom(Classroom $classroom)
    {
        if (!$classroom->students()->where('user_id', auth()->id())->where('status', 'accepted')->exists()) {
            abort(403);
        }

        return view('student.classrooms.show', [
            'classroom' => $classroom,
            'quizzes' => $classroom->quizzes()
                            ->available()
                            ->withCount('questions')
                            ->paginate(10)
        ]);
    }

    public function joinClassroom(Request $request, Classroom $classroom)
    {
        // sends request
    }


    public function quizzes()
    {
        // get all accessible quizes
    }

public function startQuiz(Quiz $quiz)
{
    if ($quiz->results()->where('student_id', auth()->id())->exists()) {
        return back()->with('error', 'You already completed this quiz');
    }

    return view('student.quizzes.take', [
        'quiz' => $quiz->load(['questions.answers']),
        'expires_at' => $quiz->expires_at
    ]);
}

public function submitQuiz(Request $request, Quiz $quiz)
{
    $student = auth()->user();

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
            'is_correct' => $isCorrect
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
    }
}
