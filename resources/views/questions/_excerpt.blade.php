<div class="media post">
    <div class="d-flex flex-column counters">
        <div class="vote">
            <strong>{{ $question->votes_count }}</strong> {{ \Illuminate\Support\Str::plural('vote', $question->votes_count) }}
        </div>

        <div class="status {{ $question->status }}">
            <strong>{{ $question->answers_count }}</strong> {{ \Illuminate\Support\Str::plural('answer', $question->answers_count) }}
        </div>

        <div class="view">
            {{ $question->views . " " . \Illuminate\Support\Str::plural('view', $question->views) }}
        </div>

    </div>
    <div class="media-body">
        <div class="d-flex align-content-center">
            <h3 class="mt-0">
                <a href="{{ $question->url }}">{{ $question->title }}</a>
            </h3>
            <div class="ml-auto">
                @can('update', $question)
                    <a class="btn btn-outline-info btn-sm" href="{!! route('questions.edit', $question->id) !!}">Edit</a>
                @endcan
                @can('delete', $question)
                    {!! Form::open(['route' => ['questions.destroy', $question->id], 'method' => 'DELETE', 'class' => 'form-delete']) !!}
                    {!! Form::submit('delete',['class' => 'btn btn-sm btn-outline-danger', 'onclick' => 'return confirm("Are you sure?")']) !!}
                    {!! Form::close() !!}
                @endcan
            </div>
        </div>
        <p class="lead">
            Asked by
            <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
            <small>{{ $question->created_date }}</small>
        </p>
        {{\Illuminate\Support\Str::limit($question->body_html, 250)}}
    </div>
</div>
