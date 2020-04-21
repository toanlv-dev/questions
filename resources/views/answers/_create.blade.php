<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3> Your Answer </h3>
                    <hr>
                    {!! Form::open(['route' => ['question.answer.store', 'slug' => $question->slug], 'method' => 'POST']) !!}
                    <div class="form-control">
                        {!! Form::textarea('body', old('body', $question->body),['class' => "form-control " . ($errors->has('body')? 'is-invalid' : '') , 'rows' => 6]) !!}
                    </div>
                    <div class="form-control">
                        {!! Form::submit('Submit', ['class'=> 'btn btn-outline-primary btn-lg']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
