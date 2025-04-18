<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function show(Quiz $quiz)
    {
    }

    public function storeQuestion(Request $request, Quiz $quiz)
    {
    }

    public function updateQuestion(Request $request, Question $question)
    {
    }

    public function deleteQuestion(Question $question)
    {
    }

    public function reorderQuestions(Request $request, Quiz $quiz)
    {
    }

    // public function toggleAvailability(Quiz $quiz)
    // {
    // not sure about this one yet
    // }
}
