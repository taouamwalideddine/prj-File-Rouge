<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'teacher_id',
        'description',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'classroom_student')
            ->withTimestamps()
            ->withPivot('status');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function pendingRequests()
    {
        return $this->belongsToMany(User::class, 'classroom_student')
            ->withTimestamps()
            ->wherePivot('status', 'pending');
    }

    public function acceptedStudents()
    {
        return $this->belongsToMany(User::class, 'classroom_student')
                    ->whereNull('deleted_at');
    }
}
