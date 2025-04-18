<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class TeacherController extends Controller
{
    use AuthorizesRequests;

    public function dashboard()
    {
        $teacher = Auth::user();
        $classroom = $teacher->classroom;

        $data = [
            'classroom' => $classroom,
            'pendingRequests' => $classroom?->pendingRequests()->count() ?? 0,
            'recentQuizzes' => $classroom?->quizzes()->latest()->take(3)->get() ?? collect(),
            'studentCount' => $classroom?->acceptedStudents()->count() ?? 0
        ];

        return view('teacher.dashboard', $data);
    }

    public function manageClassroom()
    {
        $classroom = Auth::user()->classroom;

        if (!$classroom) {
            return redirect()->route('teacher.dashboard')->with('error', 'You need to create a classroom first');
        }

        return view('teacher.', [
            'classroom' => $classroom,
            'students' => $classroom->acceptedStudents()->paginate(10)
        ]);
    }

    public function joinRequests()
    {
        $requests = Auth::user()->classroom?->pendingRequests()->paginate(10);

        return view('teacher.classroom.requests', [
            'requests' => $requests
        ]);
    }

    public function acceptRequest(User $student)
    {
        $classroom = Auth::user()->classroom;

        $classroom->students()->updateExistingPivot($student->id, [
            'status' => 'accepted'
        ]);

        return back()->with('success', 'Student request accepted');
    }

    public function rejectRequest(User $student)
    {
        Auth::user()->classroom->students()->detach($student->id);

        return back()->with('success', 'Student request rejected');
    }

    public function quizzes()
    {
        $quizzes = Auth::user()->classroom?->quizzes()->latest()->paginate(10);

        return view('teacher.quizzes.index', [
            'quizzes' => $quizzes
        ]);
    }

    public function createQuiz()
    {
        return view('teacher.quizzes.create', [
            'classroom' => Auth::user()->classroom
        ]);
    }

    public function storeQuiz(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:mcq,true_false',
            'available_at' => 'required|date',
            'expires_at' => 'required|date|after:available_at',
            'classroom_id' => 'required|exists:classrooms,id'
        ]);

        $quiz = Quiz::create([
            ...$validated,
            'user_id' => Auth::id()
        ]);

        // TODO: add notification to students

        return redirect()->route('teacher.quizzes')->with('success', 'Quiz created successfully');
    }

    public function deleteQuiz(Quiz $quiz)
    {
        $this->authorize('delete', $quiz);

        $quiz->delete();

        return back()->with('success', 'Quiz deleted successfully');
    }

    public function quizResults(Quiz $quiz)
    {
        $this->authorize('viewResults', $quiz);

        return view('teacher.quizzes.results', [
            'quiz' => $quiz->load('results.student'),
            'averageScore' => $quiz->results()->avg('score'),
            'topStudents' => $quiz->results()
                ->with('student')
                ->orderByDesc('score')
                ->take(5)
                ->get()
        ]);
    }
}
