<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

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

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function classroom()
    {
        if ($this->role === 'teacher') {
            return $this->hasOne(Classroom::class, 'teacher_id');
        }
        return null;
    }

    public function enrolledClassrooms()
    {
        // For students - classrooms they've joined
        return $this->belongsToMany(Classroom::class, 'classroom_student')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function quizResults()
    {
        return $this->hasMany(QuizResult::class, 'student_id');
    }

    public function studentAnswers()
    {
        return $this->hasMany(StudentAnswer::class, 'student_id');
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isTeacher()
    {
        return $this->role === 'teacher';
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
