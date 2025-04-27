<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'pending_teachers' => User::where('role', 'teacher')
                                    ->where('status', 'pending')
                                    ->count(),
            'active_quizzes' => Quiz::active()->count()
        ];

        $recentActivity = ActivityLog::latest()
                                   ->take(5)
                                   ->get();

        return view('admin.dashboard', compact('stats', 'recentActivity'));
    }

    public function users()
    {
        $users = User::withTrashed()
                    ->latest()
                    ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function pendingTeachers()
    {
        $teachers = User::where('role', 'teacher')
                       ->where('status', 'pending')
                       ->latest()
                       ->paginate(10);

        return view('admin.teachers.pending', compact('teachers'));
    }

    public function approveTeacher(User $teacher)
    {
        $teacher->update(['status' => 'approved']);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'description' => "Approved teacher: {$teacher->name}"
        ]);

        return redirect()->route('admin.teachers.pending')
                       ->with('success', 'Teacher approved successfully');
    }

    public function rejectTeacher(User $teacher)
    {
        $teacher->update(['status' => 'rejected']);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'description' => "Rejected teacher: {$teacher->name}"
        ]);

        return redirect()->route('admin.teachers.pending')
                       ->with('success', 'Teacher request rejected');
    }

    public function banUser(User $user)
    {
        $user->delete();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'description' => "Banned user: {$user->name}"
        ]);

        return back()->with('success', 'User banned successfully');
    }

    public function reactivateUser(User $user)
    {
        $user->restore();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'description' => "Reactivated user: {$user->name}"
        ]);

        return back()->with('success', 'User reactivated successfully');
    }

    public function quizzes()
    {
        $quizzes = Quiz::with(['classroom', 'author'])
                      ->latest()
                      ->paginate(10);

        return view('admin.quizzes.index', compact('quizzes'));
    }

    public function deleteQuiz(Quiz $quiz)
    {
        $quiz->delete();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'description' => "Deleted quiz: {$quiz->title}"
        ]);

        return back()->with('success', 'Quiz deleted successfully');
    }
}
