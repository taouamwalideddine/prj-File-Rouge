<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'classroom_id',
        'user_id',
        'title',
        'description',
        'type',
        'available_at',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime'
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function results()
    {
        return $this->hasMany(QuizResult::class);
    }

    public function scopeAvailable($query)
{
    return $query->where(function($q) {
        $q->whereNull('expires_at')
          ->orWhere('expires_at', '>', now());
    });
}

    public function isActive()
{
        return !$this->expires_at || $this->expires_at > now();
}
    public function isAccessibleBy(User $user)
{
        return $this->classroom->students()
            ->where('user_id', $user->id)
            ->where('status', 'accepted')
            ->exists();
}

    public function totalPoints()
{
        return $this->questions->sum('points');
}
public function podium()
{
    return $this->hasMany(QuizResult::class)
        ->orderByDesc('score')
        ->with('student')
        ->take(5);
}

}
