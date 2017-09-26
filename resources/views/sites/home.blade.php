@extends('master')
@section('content')
    @include('layouts.menu')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-10 mx-auto">
                <h2>Zuletzt geleistete Arbeitszeiten</h2>
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Benutzer</th>
                            <th>Zeit</th>
                            <th>Beschreibung</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mostRecentWorkingTimes as $workingTime)
                            <tr>
                                <td scope="row">{{$workingTime->user->name}}</td>
                                <td>{{$workingTime->working_time}}</td>
                                <td>{{$workingTime->description}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h2>Aufräumen</h2>

            </div>
        </div>
    </div>
@endsection
