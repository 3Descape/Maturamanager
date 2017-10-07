@extends('auth.master')

@section('content')
    <div class="row" style="height: 100vh">
        <div class="col-md-4 col-11 mx-auto my-auto">
            <div class="card my-auto">
                <div class="card-header">Passwort zurücksetzen</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">E-Mail Adresse</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Sende E-Mail zum Zurücksetzten
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
