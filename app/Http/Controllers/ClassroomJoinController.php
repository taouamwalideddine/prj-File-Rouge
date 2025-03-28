<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ClassroomJoinController extends Controller
{
    public function join(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:8'
        ]);

        $classroom = Classroom::where('code', $request->code)->firstOrFail();
        $userId = Auth::user()->id;

        if (!$classroom->students()->where('user_id', $userId)->exists()) {
            $classroom->students()->attach($userId);

            return redirect()->route('student.dashboard')->with('success', 'Successfully joined classroom!');
        }

        return redirect()->back()->with('error', 'You are already in this classroom');
    }
}
