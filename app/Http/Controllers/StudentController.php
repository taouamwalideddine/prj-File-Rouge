<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Quiz;
use App\Models\QuizResult;
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
    }

    public function submitQuiz(Request $request, Quiz $quiz)
    {
        // calculer les resulta
    }

    public function quizResults(QuizResult $result)
    {
    }
}
