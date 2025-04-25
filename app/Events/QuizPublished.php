<?php

namespace App\Events;

use App\Models\Quiz;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class QuizPublished implements ShouldBroadcast
{
    public $quiz;
    public $message;

    public function __construct(Quiz $quiz)
    {
        $this->quiz = $quiz;
        $this->message = "New quiz available: {$quiz->title}";
    }

    public function broadcastOn()
    {
        return new Channel('classroom.' . $this->quiz->classroom_id);
    }

    public function broadcastAs()
    {
        return 'quiz.published';
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message,
            'quiz' => [
                'id' => $this->quiz->id,
                'title' => $this->quiz->title,
                'expires_at' => $this->quiz->expires_at?->toDateTimeString()
            ],
            'classroom_id' => $this->quiz->classroom_id
        ];
    }
}
