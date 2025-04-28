<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
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
                        ->whereNull('deleted_at')
                        ->doesntHave('classroom')
                        ->paginate(10)
    ]);
}

public function approveTeacher(User $teacher)
{
    Classroom::create([
        'name' => $teacher->name . "'s Classroom",
        'teacher_id' => $teacher->id
    ]);

    return back()->with('success', "Teacher {$teacher->name} approved and classroom created");
}

public function rejectTeacher(User $teacher)
{
    $teacher->delete();
    return back()->with('success', "Teacher {$teacher->name} rejected");
}

    public function unbanUser($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();
        return back()->with('success', "User {$user->name} unbanned");
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
