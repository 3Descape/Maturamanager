@extends('master')
@section('content')
    @include('layouts.menu')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-10 col-12 col-sm-11 mx-auto row">
                <working-time-confirm :working-times-prop="{{$unconfirmed}}"></working-time-confirm>
            </div>
        </div>
    </div>
@endsection
