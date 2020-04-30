<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * One user can create many questions.
     */
    public function questions() {
       return $this->hasMany(Question::class);
    }

    public function getUrlAttribute() {
//        return route('users.show', $this->id);
        return '#';
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }

    public function getAvatarAttribute() {
        $email = "someone@somewhere.com";
        $size = 32;
        return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?s=" . $size;
    }

    public function favorites() {
        return $this->belongsToMany(Question::class, 'favorites', 'user_id', 'question_id')->withTimestamps();
    }

    public function voteQuestions()
    {
        return $this->morphedByMany(Question::class, 'votable')->withTimestamps();
    }

    public function voteAnswers()
    {
        return $this->morphedByMany(Answer::class, 'votable')->withTimestamps();
    }

    public function voteQuestion(Question $question, $vote)
    {
        $voteQuestions = $this->voteQuestions();
        if($voteQuestions->where('votable_id', $question->id)->exists()) {
            $voteQuestions->updateExistingPivot($question->id, ['vote' => $vote]);
        }else {
            $voteQuestions->attach($question->id, ['vote' => $vote]);
        }

        $question->load('votes');
        $downVote = $question->downVotes()->sum('vote');
        $upVote = $question->upVotes()->sum('vote');

        $question->votes_count = $downVote + $upVote;
        $question->save();
    }

    public function voteAnswer(Answer $answer, $vote)
    {
        $voteAnswers = $this->voteAnswers();
        if($voteAnswers->where('votable_id', $answer->id)->exists()) {
            $voteAnswers->updateExistingPivot($answer->id, ['vote' => $vote]);
        }else {
            $voteAnswers->attach($answer->id, ['vote' => $vote]);
        }

        $answer->load('votes');
        $downVote = $answer->downVotes()->sum('vote');
        $upVote = $answer->upVotes()->sum('vote');

        $answer->votes_count = $downVote + $upVote;
        $answer->save();
    }
}
