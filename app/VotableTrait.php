<?php


namespace App;


trait VotableTrait
{
    public function votes()
    {
        return $this->morphToMany(User::class, 'votable');
    }

    public function downVotes()
    {
        return $this->votes()->wherePivot('vote', $this::VOTE_DOWN);
    }

    public function upVotes()
    {
        return $this->votes()->wherePivot('vote', $this::VOTE_UP);
    }
}
