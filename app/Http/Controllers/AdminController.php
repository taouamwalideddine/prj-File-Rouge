<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'pendingTeachers' => User::where('role', 'teacher')
                                  ->where('status', 'pending')
                                  ->count(),
            'bannedUsers' => User::onlyTrashed()->count(),
            'quizzesCount' => Quiz::count()
        ]);
    }

    // Teacher Approval
public function pendingTeachers()
{
    return view('admin.teachers.pending', [
        'teachers' => User::where('role', 'teacher')
                        ->where('status', 'pending')
                        ->paginate(10)
    ]);
}

public function approveTeacher(User $teacher)
{
    $teacher->update(['status' => 'approved']);
    return back()->with('success', "Teacher {$teacher->name} approved");
}

public function rejectTeacher(User $teacher)
{
    $teacher->update(['status' => 'rejected']);
    return back()->with('success', "Teacher {$teacher->name} rejected");
}

    // User Ban/Unban
    public function users()
    {
        return view('admin.users.index', [
            'users' => User::withTrashed()
                         ->latest()
                         ->paginate(10)
        ]);
    }

    public function banUser(User $user)
    {
        $user->delete();
        return back()->with('success', "User {$user->name} banned");
    }

    public function unbanUser($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();
        return back()->with('success', "User {$user->name} unbanned");
    }

    // Quiz Management
    public function quizzes()
    {
        return view('admin.quizzes.index', [
            'quizzes' => Quiz::with(['classroom', 'author'])
                          ->latest()
                          ->paginate(10)
        ]);
    }

    public function deleteQuiz(Quiz $quiz)
    {
        $quiz->delete();
        return back()->with('success', "Quiz '{$quiz->title}' deleted");
    }
}
