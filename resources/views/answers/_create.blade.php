<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3> Your Answer </h3>
                    <hr>
                    {!! Form::open(['route' => ['questions.answers.store', $question->id], 'method' => 'POST']) !!}
                    <div class="form-group">
                        {!! Form::textarea('body', old('body'),['class' => "form-control " . ($errors->has('body')? 'is-invalid' : '') , 'rows' => 6]) !!}
                        @if($errors->has('body'))
                            <div class="invalid-feedback">
                                <strong>{!! $errors->first('body') !!}</strong>
                            </div>

                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Submit', ['class'=> 'btn btn-outline-primary btn-lg']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
