@extends('auth.master')

@section('content')
    <div class="row" style="height: 100vh">
        <div class="col-md-4 col-11 mx-auto my-auto">
            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                    <label for="text">Name</label>

                    <input id="text" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus aria-describedby="nameHelpBlock">

                    @if ($errors->has('name'))
                        <span id="nameHelpBlock" class="form-text text-muted">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif

                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                    <label for="password">Passwort</label>

                    <input id="password" type="password" class="form-control" name="password" required aria-describedby="passwordHelpBlock">

                    @if ($errors->has('password'))
                        <span id="passwordHelpBlock" class="form-text text-muted">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Angemeldet bleiben
                        </label>
                    </div>

                </div>

                <div class="form-group">

                    <button type="submit" class="btn btn-primary">
                        Login
                    </button>

                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        Passwort vergessen?
                    </a>

                </div>
            </form>
        </div>
    </div>
@endsection
