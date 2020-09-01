<a title="Click to mark as favorite Question"
   class="favorite mt-2 {{ \Illuminate\Support\Facades\Auth::guest()? 'off' : ($model->is_favorited? 'favorited' : '')  }}"
   onclick="event.preventDefault();document.getElementById('question-favorite-{{ $model->id }}').submit();"
>
    <i class="fas fa-star fa-2x"></i>
    <span class="favorites-count">{{ $model->favorites_count }}</span>
</a>
{{ Form::open(['url' => '/questions/'. $model->id .'/favorites', 'id' => 'question-favorite-' . $model->id, 'style' => 'display: none', 'method' => $model->is_favorited ? 'DELETE' : 'POST']) }}
{{ Form::close() }}
