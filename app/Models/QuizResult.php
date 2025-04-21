<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'student_id',
        'score',
        'total_questions',
        'total_points',
        'answer_details',
        'completed_at'
    ];

    protected $casts = [
        'answer_details' => 'array',
        'completed_at' => 'datetime'
    ];

    // Relationships
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function getScorePercentageAttribute()
    {
        return $this->total_points > 0
            ? round(($this->score / $this->total_points) * 100, 2)
            : 0;
    }

    public function getCorrectAnswersCountAttribute()
    {
        return collect($this->answer_details)
            ->filter(fn($answer) => $answer['is_correct'])
            ->count();
    }

    public function getTotalPointsAttribute()
    {
        return $this->quiz->questions->sum('points');
    }
}
