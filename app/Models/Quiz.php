<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'classroom_id', 'user_id', 'title', 'description', 'type',
        'available_at', 'expires_at'
    ];

    protected $casts = [
        'available_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function teacher()
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

    public function isAvailable()
    {
        $now = now();
        return ($this->available_at === null || $now->gte($this->available_at)) &&
               ($this->expires_at === null || $now->lte($this->expires_at));
    }
}
