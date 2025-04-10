<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClassroomController extends Controller
{
public function store(Request $request)
{
    $request->validate(['name' => 'required|string|max:255']);

// correction avec les statistic pour l'ensengient

// voir les resultat de chaque quize avec les detail de

    $classroom = Classroom::create([
        'name' => $request->name,
        'teacher_id' => Auth::user()->id,
        'code' => Str::random(8),
    ]);

    return redirect()->route('classrooms.show', $classroom);
}

public function index()
{
    $classrooms = Auth::user()->teachingClasses;
    return view('classrooms.index', compact('classrooms'));
}

public function show(Classroom $classroom)
{
    /** @var App\Models\User $user */
    $user = Auth::user();
    if ($user->cannot('view', $classroom)) {
        abort(403);
    }

    return view('classrooms.show', compact('classroom'));
}
}
