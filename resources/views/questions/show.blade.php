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
                                    <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary"> Back to
                                        all Questions </a>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="media">
                            <div class="d-flex flex-column vote-controls">
                                <a title="This question is useful"
                                   class="vote-up {{ auth()->guest()? 'off' : '' }}"
                                   onclick="event.preventDefault();document.getElementById('vote-up-question-{{ $question->id }}').submit();"
                                >
                                    <i class="fas fa-caret-up fa-2x"> </i>
                                </a>
                                {{ Form::open(['url' => '/questions/'. $question->id .'/vote', 'id' => 'vote-up-question-' . $question->id, 'style' => 'display: none', 'method' => 'POST']) }}
                                {{ Form::hidden('vote', 1) }}
                                {{ Form::close() }}
                                <span class="votes-count">{{ $question->votes_count }}</span>
                                <a title="This question is not useful"
                                   class="vote-down {{auth()->guest()? 'off' : ''}}"
                                   onclick="event.preventDefault();document.getElementById('vote-down-question-{{ $question->id }}').submit();"
                                >
                                    <i class="fas fa-caret-down fa-2x"></i>
                                </a>
                                {{ Form::open(['url' => '/questions/'. $question->id .'/vote', 'id' => 'vote-down-question-' . $question->id, 'style' => 'display: none', 'method' => 'POST']) }}
                                {{ Form::hidden('vote', -1) }}
                                {{ Form::close() }}
                                <a title="Click to mark as favorite Question"
                                   class="favorite mt-2 {{ \Illuminate\Support\Facades\Auth::guest()? 'off' : ($question->is_favorited? 'favorited' : '')  }}"
                                   onclick="event.preventDefault();document.getElementById('question-favorite-{{ $question->id }}').submit();"
                                >
                                    <i class="fas fa-star fa-2x"></i>
                                    <span class="favorites-count">{{ $question->favorites_count }}</span>
                                </a>
                                {{ Form::open(['url' => '/questions/'. $question->id .'/favorites', 'id' => 'question-favorite-' . $question->id, 'style' => 'display: none', 'method' => $question->is_favorited ? 'DELETE' : 'POST']) }}
                                {{ Form::close() }}
                            </div>
                            <div class="media-body">
                                {!! $question->body_html !!}
                                <div class="float-right">
                                    <span class="mt-2">{!! $question->created_date !!}</span>
                                    <div class="media mt-1">
                                        <a href="{!! $question->user->url !!}" class="pr-2"><img
                                                src="{!! $question->user->avatar !!}"></a>
                                        <div class="media-body mt-1">
                                            <a href="{!! $question->user->url !!}"
                                               class="pr-2">{!! $question->user->name !!}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @include('answers._index',[
            'answers' => $question->answers,
            'answers_count' => $question->answers_count
        ])

        @include('answers._create',[
            'question' => $question
        ])
    </div>
@endsection
