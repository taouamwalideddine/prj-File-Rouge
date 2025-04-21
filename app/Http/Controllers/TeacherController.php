<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function dashboard()
    {
        $teacher = Auth::user();
        $classroom = $teacher->classroom;

        if (!$classroom) {
            $classroom = Classroom::create([
                'name' => $teacher->name . "'s Class",
                'teacher_id' => $teacher->id
            ]);
        }

        return view('teacher.dashboard', [
            'classroom' => $classroom,
            'pendingRequests' => $classroom->pendingRequests()->count(),
            'studentCount' => $classroom->acceptedStudents()->count(),
            'quizzes' => $classroom->quizzes()->latest()->get(),
            'recentQuizzes' => $classroom->quizzes()->latest()->take(3)->get()
        ]);
    }

    public function manageClassroom()
    {
        $classroom = Auth::user()->classroom;

        return view('teacher.classroom.manage', [
            'classroom' => $classroom,
            'students' => $classroom->acceptedStudents()->paginate(10)
        ]);
    }

    public function joinRequests()
    {
        $requests = Auth::user()->classroom->pendingRequests()->paginate(10);

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

        return back()->with('success', 'Student added to class');
    }

    public function rejectRequest(User $student)
    {
        Auth::user()->classroom->students()->detach($student->id);

        return back()->with('success', 'Request rejected');
    }

    public function quizzes()
    {
        $quizzes = Auth::user()->classroom->quizzes()
        ->withCount('questions')
        ->latest()
        ->paginate(10);

        return view('teacher.quizzes.index', [
            'quizzes' => $quizzes
        ]);
    }
}
