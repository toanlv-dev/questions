<?php

namespace App\Policies;

use App\User;
use App\question;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
{
    use HandlesAuthorization;

    public function update(User $user, question $question)
    {
        return $user->id === $question->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\question  $question
     * @return mixed
     */
    public function delete(User $user, question $question)
    {
        return $user->id === $question->user_id && $question->answers < 1;
    }

}
