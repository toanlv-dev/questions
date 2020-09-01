@if($model instanceof \App\Question)
    @php
        $name = 'question';
        $actionNameURI = 'questions';
    @endphp
@elseif($model instanceof \App\Answer)
    @php
        $name = 'answer';
        $actionNameURI = 'answers';
    @endphp
@endif

@php
    $formId =  $name ."-". $model->id;
    $actionVote = '/'. $actionNameURI .'/'. $model->id .'/vote';
@endphp
<div class="d-flex flex-column vote-controls">
    <a title="This {{ $name }} is useful"
       class="vote-up {{ auth()->guest()? 'off' : '' }}"
       onclick="event.preventDefault();document.getElementById('vote-up-{{ $formId }}').submit();"
    >
        <i class="fas fa-caret-up fa-2x"> </i>
    </a>
    {{ Form::open(['url' => $actionVote, 'id' => 'vote-up-'. $name .'-' . $model->id, 'style' => 'display: none', 'method' => 'POST']) }}
    {{ Form::hidden('vote', 1) }}
    {{ Form::close() }}
    <span class="votes-count">{{ $model->votes_count }}</span>
    <a title="This {{ $name }} is not useful"
       class="vote-down {{auth()->guest()? 'off' : ''}}"
       onclick="event.preventDefault();document.getElementById('vote-down-{{ $formId }}').submit();"
    >
        <i class="fas fa-caret-down fa-2x"></i>
    </a>
    {{ Form::open(['url' => $actionVote, 'id' => 'vote-down-'. $name .'-' . $model->id, 'style' => 'display: none', 'method' => 'POST']) }}
    {{ Form::hidden('vote', -1) }}
    {{ Form::close() }}
    @if($model instanceof \App\Question)
        @include('shared._favotire', [
            'model' => $model
        ])
    @elseif($model instanceof \App\Answer)
        @include('shared._accept', [
            'model' => $model
        ])
    @endif
</div>
