@extends('master')
@section('title')
    Tickets
@endsection
@section('content')
    @include('layouts.menu')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-sm-11 mx-auto row">
                @foreach ($working_tickets as $ticket)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 p-1">
                        <div class="card h-100">
                            <div class="card-body">
                                <h4 class="card-title d-flex">{{$ticket->name}}
                                    <div class="ml-auto align-self-start d-flex">
                                        @if($ticket->completed)
                                            <div class="btn btn-success">
                                                <i class="fa fa-check"></i>
                                            </div>
                                        @else
                                            <div class="btn btn-danger">
                                                <i class="fa fa-cog"></i>
                                            </div>
                                        @endif
                                    </div>
                                </h4>
                                <div class="mb-2">
                                    {!!$ticket->html!!}
                                </div>
                                @if($ticket->users->count())
                                    <a class="btn btn-primary" data-toggle="collapse" href="#users{{$ticket->id}}" aria-expanded="false" aria-controls="users">
                                      Personen <i class="fa fa-caret-down"></i>
                                    </a>

                                    <div class="collapse" id="users{{$ticket->id}}">
                                        <ul class="list-group my-2">
                                            @foreach ($ticket->users as $user)
                                                <li class="list-group-item d-flex">
                                                    <a href="{{route('user_show', $user->slug)}}">{{$user->name}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <p class="mt-1">
                                    Arbeitszeit gesamt: {{round($ticket->working_times->sum('working_time')/60, 2)}}
                                </p>
                            </div>

                            <div class="card-footer text-muted">
                                Autor: <a href="{{route('user_show', $ticket->author->slug)}}">{{$ticket->author->name}}</a>
                                <p>Zuletzt bearbeitet {{$ticket->updated_at->diffForHumans()}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-md-12">
                    @if($working_tickets->count())
                        {{ $working_tickets->links('layouts.paginator')}}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
