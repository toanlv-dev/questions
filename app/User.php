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

    protected $appends = [
        'url',
        'avatar'
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
        return $this->_vote($voteQuestions, $question, $vote);
    }

    public function voteAnswer(Answer $answer, $vote)
    {
        $voteAnswers = $this->voteAnswers();
        return $this->_vote($voteAnswers, $answer, $vote);
    }

    private function _vote($relationship, $model, $vote)
    {
        if($relationship->where('votable_id', $model->id)->exists()) {
            $relationship->updateExistingPivot($model->id, ['vote' => $vote]);
        }else {
            $relationship->attach($model->id, ['vote' => $vote]);
        }

        $model->load('votes');
        $downVote = $model->downVotes()->sum('vote');
        $upVote = $model->upVotes()->sum('vote');

        $model->votes_count = $downVote + $upVote;
        $model->save();

        return $model->votes_count;
    }
}
