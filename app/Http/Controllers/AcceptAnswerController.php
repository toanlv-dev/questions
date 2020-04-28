<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;

class AcceptAnswerController extends Controller
{
    public function __invoke(Answer $answer)
    {
        $answer->question->acceptAnswer($answer);
        return back()->with('success', 'Answer has been accept');
    }
}
