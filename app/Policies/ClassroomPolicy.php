<?php

namespace App\Policies;

use App\Models\Classroom;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClassroomPolicy
{
    use HandlesAuthorization;

    /**
     * determine if the user can view the classroom.
     */
    public function view(User $user, Classroom $classroom)
    {
        return $classroom->students()
            ->where('user_id', $user->id)
            ->where('status', 'accepted')
            ->exists();
    }

    /**
     * determine if the user can join the classroom.
     */
    public function join(User $user, Classroom $classroom)
    {
        return !$classroom->students()
            ->where('user_id', $user->id)
            ->exists();
    }

    /**
     * determine if the user can leave the classroom.
     */
    public function leave(User $user, Classroom $classroom)
    {
        return $classroom->students()
            ->where('user_id', $user->id)
            ->where('status', 'accepted')
            ->exists();
    }

    /**
     * determine if the user can view quizzes in the classroom.
     */
    public function viewQuizzes(User $user, Classroom $classroom)
    {
        return $this->view($user, $classroom);
    }

    /**
     * determine if the user can participate in classroom quizzes.
     */
    public function participate(User $user, Classroom $classroom)
    {
        return $this->view($user, $classroom) &&
               $classroom->is_active;
    }

    /**
     * determine if the user can view classroom members.
     */
    public function viewMembers(User $user, Classroom $classroom)
    {
        return $this->view($user, $classroom);
    }
}
