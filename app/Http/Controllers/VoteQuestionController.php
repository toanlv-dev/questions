<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class VoteQuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Question $question, Request $request)
    {
        $vote = $request->get('vote');
        $votesCount = auth()->user()->voteQuestion($question, $vote);
        if($request->expectsJson())
        {
            return response()->json([
                'message' => 'Thanks for the vote',
                'votesCount' => $votesCount
            ]);
        }
        return back();
    }
}
