<div class="container">
    <div class="card">
        @if (Session::has('sucess'))
        <div class="alert alert-success" role="alert">
            {{ session::get('sucess') }}
        </div>
        @endif
        @if (Session::has('fail'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('fail') }}
            </div>
        @endif
    </div>