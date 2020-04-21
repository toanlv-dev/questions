<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $answers_count . " " . \Illuminate\Support\Str::plural('Answer', $answers_count)}} </h2>
                    <hr>
                    @foreach($answers as $answer)
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