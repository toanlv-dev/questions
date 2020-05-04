<div class="media">
    @include('shared._vote', [
            'model' => $answer
        ])
    <div class="media-body post">
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
                @include('shared._auth', [
                    'model' => $answer,
                    'label' => 'answered'
                ])
            </div>

        </div>
    </div>
</div>
