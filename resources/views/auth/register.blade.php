@extends('auth.master')

@section('content')
    <div class="row" style="height: 100vh">
        <div class="col-md-4 col-11 mx-auto my-auto">
            <form method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                    <label for="name">Vorname Nachname</label>

                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus aria-describedby="nameHelpBlock">

                    @if ($errors->has('name'))
                        <span id="nameHelpBlock" class="form-text text-muted">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                    <label for="email">E-Mail Adresse</label>

                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required aria-describedby="emailHelpBlock">

                    @if ($errors->has('email'))
                        <span id="emailHelpBlock" class="form-text text-muted">
                            <strong>{{ $errors->first('email') }}</strong>
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
                    <label for="password-confirm">Passwort bestätigen</label>

                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Registrieren
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
