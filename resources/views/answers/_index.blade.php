<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $answers_count . " " . \Illuminate\Support\Str::plural('Answer', $answers_count)}} </h2>
                    <hr>
                    @include('layouts._message')
                    @foreach($answers as $answer)
                        <div class="media">

                            <div class="d-flex flex-column vote-controls">
                                <a title="This answer is useful"
                                    class="vote-up {{ auth()->guest()? 'off' : '' }}"
                                    onclick="event.preventDefault();document.getElementById('vote-up-answer-{{ $answer->id }}').submit();"
                                >
                                    <i class="fas fa-caret-up fa-2x"> </i>
                                </a>
                                {{ Form::open(['url' => 'answers/'. $answer->id .'/vote', 'id' => 'vote-up-answer-' . $answer->id, 'style' => 'display: none', 'method' => 'POST']) }}
                                {{ Form::hidden('vote', 1) }}
                                {{ Form::close() }}
                                <span class="votes-count">{{ $answer->votes_count }}</span>
                                <a title="This answer is not useful"
                                    class="vote-down {{ auth()->guest()? 'off' : '' }}"
                                    onclick="event.preventDefault();document.getElementById('vote-down-answer-{{ $answer->id }}').submit();"
                                >
                                    <i class="fas fa-caret-down fa-2x"></i>
                                </a>
                                {{ Form::open(['url' => 'answers/'. $answer->id .'/vote', 'id' => 'vote-down-answer-' . $answer->id, 'style' => 'display: none', 'method' => 'POST']) }}
                                {{ Form::hidden('vote', -1) }}
                                {{ Form::close() }}
                                @can('accept', $answer)
                                    <a title="Click to mark as best answer"
                                       class="{{ $answer->status }} mt-2"
                                       onclick="event.preventDefault();document.getElementById('answers-accept-{{ $answer->id }}').submit();"
                                    >
                                        <i class="fas fa-check fa-2x"></i>
                                    </a>
                                    {{ Form::open(['route' => ['answers.accept', $answer->id], 'id' => 'answers-accept-' . $answer->id, 'style' => 'display: none', 'method' => 'POST']) }}
                                    {{ Form::close() }}
                                @else
                                    @if($answer->is_best)
                                        <a title="This answer as best answer"
                                           class="{{ $answer->status }} mt-2"
                                        >
                                            <i class="fas fa-check fa-2x"></i>
                                        </a>
                                    @endif
                                @endcan
                            </div>
                            <div class="media-body">
                                {!! $answer->body_html !!}
                                <div class="row">
                                    <div class="col-4">
                                        @can('update', $answer)
                                            <a class="btn btn-outline-info btn-sm" href="{!! route('questions.answers.edit', [$question->id, $answer->id]) !!}">Edit</a>
                                        @endcan
                                        @can('delete', $answer)
                                            {!! Form::open(['route' => ['questions.answers.destroy', $question->id, $answer->id], 'method' => 'DELETE', 'class' => 'form-delete']) !!}
                                            {!! Form::submit('delete',['class' => 'btn btn-sm btn-outline-danger', 'onclick' => 'return confirm("Are you sure?")']) !!}
                                            {!! Form::close() !!}
                                        @endcan
                                    </div>
                                    <div class="col-4"></div>
                                    <div class="col-4">
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
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
