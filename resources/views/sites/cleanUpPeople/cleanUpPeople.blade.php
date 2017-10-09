@extends('master')
@section('title')
    Aufräumperson
@endsection
@section('content')
    @include('layouts.menu')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-sm-11 mx-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Datum</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($duty_past as $person)
                            <tr>
                                <td scope="row">{{$person->user->name}}</td>
                                <td>{{$person->date->format('d.m.Y')}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
