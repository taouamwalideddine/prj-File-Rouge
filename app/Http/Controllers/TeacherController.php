<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function dashboard()
    {
        // get teachers classroom, pending requests, and recent quizzes
    }

    public function manageClassroom()
    {
    }

    public function joinRequests()
    {
    }

    public function acceptRequest(User $student)
    {
    }

    public function rejectRequest(User $student)
    {
    }

    public function quizzes()
    {
    }

    public function createQuiz()
    {
    }

    public function storeQuiz(Request $request)
    {
        // create quiz and notify students
    }

    public function deleteQuiz(Quiz $quiz)
    {
    }

    public function quizResults(Quiz $quiz)
    {
    }
}
