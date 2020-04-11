<?php

namespace App\Http\Controllers;

use App\Http\Requests\AskQuestionRequest;
use App\Question;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Gate;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $questions = Question::with('user')->latest()->paginate(5);

        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $question = new Question();
        return view('questions.create', compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(AskQuestionRequest $request)
    {
        $request->user()->questions()->create($request->only('title', 'body'));
        return redirect()->route('questions.index')->with('success', 'Your question has created');
    }

    /**
     * Display the specified resource.
     *
     * @param Question $question
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Question $question)
    {
        $question->increment('views');
        return view('questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Question $question
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function edit(Question $question)
    {
        if(Gate::denies('update-question', $question)) {
            return abort(403, 'Access denice');
        }
        return view('questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Question $question
     * @return Application|RedirectResponse|Redirector|void
     */
    public function update(AskQuestionRequest $request, Question $question)
    {
        if(Gate::denies('update-question', $question)) {
            return abort(403, 'Access denice');
        }
        $question->update($request->only('title', 'body'));
        return redirect('/questions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Question $question
     * @return Application|RedirectResponse|Redirector|void
     * @throws Exception
     */
    public function destroy(Question $question)
    {
        if(Gate::denies('delete-question', $question)) {
            return abort(403, 'Access denice');
        }
        $question->delete();
        return redirect('/questions');
    }
}
