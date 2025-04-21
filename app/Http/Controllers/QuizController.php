<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{

    public function index()
{
    $quizzes = Auth::user()->classroom->quizzes()->latest()->paginate(10);

    return view('teacher.quizzes.index', [
        'quizzes' => $quizzes
    ]);
}

    public function create()
    {
        return view('teacher.quizzes.create', [
            'classroom' => Auth::user()->classroom
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:mcq,tf',
            'expires_at' => 'nullable|date|after:now'
        ]);

        $quiz = Quiz::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'type' => $validated['type'],
            'expires_at' => $validated['expires_at'],
            'classroom_id' => Auth::user()->classroom->id,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('teacher.quizzes.show', $quiz)
               ->with('success', 'Quiz created! Now add questions.');
    }

public function show(Quiz $quiz)
{
    if ($quiz->classroom->teacher_id !== Auth::id()) {
        abort(403);
    }

    return view('teacher.quizzes.show', [
        'quiz' => $quiz->load(['questions.answers', 'classroom'])
    ]);
}

    public function storeQuestion(Request $request, Quiz $quiz)
    {
        $request->validate([
            'content' => 'required|string',
            'points' => 'required|integer|min:1',
            'answers' => $quiz->type === 'mcq' ? 'required|array|min:4' : 'nullable',
            'correct_answer' => 'required|integer'
        ]);

        $question = $quiz->questions()->create([
            'content' => $request->content,
            'points' => $request->points,
            'order' => $quiz->questions()->count()
        ]);

        if ($quiz->type === 'mcq') {
            foreach ($request->answers as $index => $answerText) {
                $question->answers()->create([
                    'content' => $answerText,
                    'is_correct' => $index == $request->correct_answer
                ]);
            }
        } else {
            $question->answers()->createMany([
                [
                    'content' => 'True',
                    'is_correct' => $request->correct_answer == 0
                ],
                [
                    'content' => 'False',
                    'is_correct' => $request->correct_answer == 1
                ]
            ]);
        }

        return back()->with('success', 'Question added successfully!');
    }

    public function updateQuestion(Request $request, Question $question)
    {
        if ($question->quiz->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'content' => 'required|string',
            'points' => 'required|integer|min:1'
        ]);

        $question->update([
            'content' => $request->content,
            'points' => $request->points
        ]);

        return back()->with('success', 'Question updated successfully!');
    }

    public function deleteQuestion(Question $question)
    {
        if ($question->quiz->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $question->delete();
        return back()->with('success', 'Question deleted successfully!');
    }

    public function reorderQuestions(Request $request, Quiz $quiz)
    {
        if ($quiz->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:questions,id'
        ]);

        foreach ($request->order as $position => $id) {
            Question::where('id', $id)->update(['order' => $position]);
        }

        return response()->json(['success' => true]);
    }

    public function destroy(Quiz $quiz)
    {
        if ($quiz->user_id !== Auth::id()) {
            abort(403);
        }

        DB::transaction(function() use ($quiz) {
            // Delete related records explicitly if not using cascading deletes
            $quiz->questions()->each(function($question) {
                $question->answers()->delete();
                $question->delete();
            });

            $quiz->results()->delete();
            $quiz->delete();
        });

        return redirect()->route('teacher.quizzes')
               ->with('success', 'Quiz deleted successfully');
    }
}
