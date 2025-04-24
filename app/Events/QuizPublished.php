<?php

namespace App\Events;

use App\Models\Quiz;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;

class QuizPublished implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets;

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
}
