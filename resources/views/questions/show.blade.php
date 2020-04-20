@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="d-flex align-content-center">
                                <h1> {!! $question->title !!} </h1>
                                <div class="ml-auto">
                                    <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary"> Back to all Questions </a>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="media">
                            <div class="d-flex flex-column vote-controls">
                                <a title="This question is useful" class="vote-up">
                                    <i class="fas fa-caret-up fa-2x"> </i>
                                </a>
                                <span class="votes-count">123</span>
                                <a title="This question is not useful" class="vote-down off">
                                    <i class="fas fa-caret-down fa-2x"></i>
                                </a>
                                <a title="Click to mark as favorite Question" class="favorite mt-2 favorited">
                                    <i class="fas fa-star fa-2x"></i>
                                    <span class="favorites-count">236</span>
                                </a>
                            </div>
                            <div class="media-body">
                                {!! $question->body_html !!}
                                <div class="float-right">
                                    <span class="mt-2">{!! $question->created_date !!}</span>
                                    <div class="media mt-1">
                                        <a href="{!! $question->user->url !!}" class="pr-2"><img src="{!! $question->user->avatar !!}"></a>
                                        <div class="media-body mt-1">
                                            <a href="{!! $question->user->url !!}" class="pr-2">{!! $question->user->name !!}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h2>{{ $question->answers_count . " " . \Illuminate\Support\Str::plural('Answer', $question->answers_count)}} </h2>
                            <hr>
                            @foreach($question->answers as $answer)
                                <div class="media">

                                    <div class="d-flex flex-column vote-controls">
                                        <a title="This answer is useful" class="vote-up">
                                            <i class="fas fa-caret-up fa-2x"> </i>
                                        </a>
                                        <span class="votes-count">123</span>
                                        <a title="This answer is not useful" class="vote-down off">
                                            <i class="fas fa-caret-down fa-2x"></i>
                                        </a>
                                        <a title="Click to mark as best answer" class="vote-accepted mt-2">
                                            <i class="fas fa-check fa-2x"></i>
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        {!! $answer->body_html !!}
                                        <div class="float-right">
                                            <span class="mt-2">{!! $answer->created_date !!}</span>
                                            <div class="media mt-1">
                                                <a href="{!! $answer->user->url !!}" class="pr-2"><img src="{!! $answer->user->avatar !!}"></a>
                                                <div class="media-body mt-1">
                                                    <a href="{!! $answer->user->url !!}" class="pr-2">{!! $answer->user->name !!}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
