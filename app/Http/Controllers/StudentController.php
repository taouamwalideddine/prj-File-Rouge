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
