<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function dashboard()
    {
    }


    public function users()
    {
    }


    public function pendingTeachers()
    {
    }


    public function approveTeacher(User $teacher)
    {
    }


    public function rejectTeacher(User $teacher)
    {
    }

    public function banUser(User $user)
    {
    }

    public function reactivateUser(User $user)
    {
    }

    public function quizzes()
    {
    }

    public function deleteQuiz(Quiz $quiz)
    {
    }
}
