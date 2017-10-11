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
                            <th>Datum</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mostRecentWorkingTimes as $workingTime)
                            <tr>
                                <td scope="row">
                                    <a href="{{route('user_show', $workingTime->user->slug)}}">{{$workingTime->user->name}}</a>
                                </td>
                                <td>{{$workingTime->working_time}}</td>
                                <td>{{$workingTime->description}}</td>
                                <td>{{$workingTime->date->format('d.m.Y')}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h2>Schlussdienst</h2>

                <clean-up-select :clean-up-prop="{{$cleanUps}}"></clean-up-select>

            </div>
        </div>
    </div>
@endsection
