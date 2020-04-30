@can('accept', $model)
    <a title="Click to mark as best answer"
       class="{{ $model->status }} mt-2"
       onclick="event.preventDefault();document.getElementById('answers-accept-{{ $model->id }}').submit();"
    >
        <i class="fas fa-check fa-2x"></i>
    </a>
    {{ Form::open(['route' => ['answers.accept', $model->id], 'id' => 'answers-accept-' . $model->id, 'style' => 'display: none', 'method' => 'POST']) }}
    {{ Form::close() }}
@else
    @if($model->is_best)
        <a title="This answer as best answer"
           class="{{ $model->status }} mt-2"
        >
            <i class="fas fa-check fa-2x"></i>
        </a>
    @endif
@endcan
