<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function classroom()
    {
        return $this->hasOne(Classroom::class, 'teacher_id');
    }

    public function enrolledClassrooms()
    {
        return $this->belongsToMany(Classroom::class, 'classroom_student')
            ->withTimestamps()
            ->withPivot('status');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'user_id');
    }

    public function quizResults()
    {
        return $this->hasMany(QuizResult::class, 'student_id');
    }

    public function answers()
    {
        return $this->hasMany(StudentAnswer::class, 'student_id');
    }

    public function pendingClassrooms()
{
    return $this->belongsToMany(Classroom::class, 'classroom_student')
        ->wherePivot('status', 'pending')
        ->withTimestamps();
}

    public function isTeacher()
    {
        return $this->role === 'teacher';
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }

    public function joinedClassrooms()
    {
        return $this->belongsToMany(Classroom::class, 'classroom_student')
            ->wherePivot('status', 'accepted')
            ->withTimestamps();
    }

    public function classroomRequests()
    {
        return $this->belongsToMany(Classroom::class)
            ->withPivot('status')
            ->withTimestamps();
    }

    public function availableQuizzes()
    {
        return Quiz::whereHas('classroom.students', function($query) {
            $query->where('user_id', $this->id)
                  ->where('status', 'accepted');
        })->available();
    }
}
