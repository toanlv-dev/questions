@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Well done!</strong> {!! session('success') !!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="false">&times;</span>
        </button>
    </div>
@endif
