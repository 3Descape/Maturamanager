@extends('master')
@section('title')
    Einstellungen
@endsection
@section('content')
    @include('layouts.menu')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-sm-11 mx-auto row">
                <div class="card">
                    <div class="card-header">
                        Passwort
                    </div>
                    <div class="card-body">
                        @if(session()->has("message"))
                            <div class="alert alert-success" role="alert">
                                {{session()->get("message")}}
                            </div>
                        @endif
                        <form action="{{route('update_settings', Auth::user()->slug)}}" method="post">
                            <div class="form-group">
                                <label for="password_old">Altes Passwort</label>
                                <input type="password" name="password_old" id="password_old" class="form-control">
                                @if($errors->has('password_old'))
                                    <div class="alert alert-danger" role="alert">
                                        <ul class="m-0">
                                            @foreach ($errors->get('password_old') as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password_new">Neues Passwort</label>
                                <input type="password" name="password" id="password_new" class="form-control">
                                @if($errors->has('password'))
                                    <div class="alert alert-danger" role="alert">
                                        <ul class="m-0">
                                            @foreach ($errors->get('password') as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password_old_confirm">Bestädige neues Passwort</label>
                                <input type="password" name="password_confirmation" id="password_old_confirm" class="form-control">
                                @if($errors->has('password_confirmation'))
                                    <div class="alert alert-danger" role="alert">
                                        <ul class="m-0">
                                            @foreach ($errors->get('password_confirmation') as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-success">
                                    Ändern
                                </button>
                            </div>
                            {{ csrf_field() }}
                            {{method_field('PUT')}}
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
