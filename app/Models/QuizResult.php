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
        'answer_details',
        'completed_at',
    ];

    protected $casts = [
        'answer_details' => 'array',
        'completed_at' => 'datetime',
    ];

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
    return round(($this->score / $this->total_points) * 100);
}

public function getCorrectAnswersCountAttribute()
{
    return collect($this->answer_details)
           ->where('is_correct', true)
           ->count();
}

public function getTotalPointsAttribute()
{
    return $this->quiz->questions->sum('points');
}
}
