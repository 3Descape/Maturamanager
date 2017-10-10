@extends('master')
@section('title')
    Tickets
@endsection
@section('content')
    @include('layouts.menu')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-sm-11 mx-auto row">
                <ticket-admin :users="{{$users}}"></ticket-admin>
            </div>
        </div>
    </div>
@endsection
