<?php

use App\Models\Classroom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('classroom.{classroomId}', function ($user, $classroomId) {
    return $user->joinedClassrooms()
        ->where('classroom_id', $classroomId)
        ->where('status', 'accepted')
        ->exists();
});
