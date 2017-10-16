@extends('master')
@section('title')
    {{$user->name}}
@endsection
@section('content')
    @include('layouts.menu')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-sm-11 mx-auto">
                <h1>{{$user->name}}</h1>

                <p>Hat gesamt {{round($user->working_times->sum('working_time')/60, 2)}} Stunden gearbeitet.</p>

                <h3 class="mt-4">Zuletzt geleistete Arbeitszeiten</h3>
                <table class="table mt-2">
                    <thead>
                        <tr>
                            <th>Zeit</th>
                            <th>Beschreibung</th>
                            <th>Ticket</th>
                            <th>Datum</th>
                        </tr>
                    </thead>
                    @foreach ($user->working_times->take(20) as $job)
                        <tr>
                            <td>
                                {{$job->working_time}}
                            </td>
                            <td>
                                {{$job->description}}
                            </td>
                            <td>
                                @if($job->working_ticket != null)
                                    {{$job->working_ticket->name}}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                {{$job->date->format('d.m.Y')}}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
