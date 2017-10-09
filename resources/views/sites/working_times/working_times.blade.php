@extends('master')
@section('title')
    Arbeitszeiten
@endsection
@section('content')
    @include('layouts.menu')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-10 col-12 col-sm-11 mx-auto row">
                <div class="col-md-12">
                    <form action="{{route('working_time_add')}}" method="post">
                        <div class="form-group">
                            <label for="working_time">
                                Zeit <p class="text-muted d-inline">in Minuten</p>
                            </label>

                            <input type="text" name="working_time"
                                id="working_time" class="form-control"
                                required value="{{old('working_time') ? old('working_time') : ''
                            }}">

                            @if($errors->has('working_time'))
                                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                    <ul class="m-0">
                                    @foreach($errors->get('working_time') as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="date">Datum</label>

                            <select name="date" id="date" class="custom-select form-control">
                                <option value="0" {{old('date') ? old('date') === "" ? "selected" : '': ''}}>Heute</option>
                                <option value="-1" {{old('date') ? old('date') === "" ? "selected" : '': ''}}>Gestern</option>
                                <option value="-2" {{old('date') ? old('date') === "" ? "selected" : '': ''}}>Vorgestern</option>
                            </select>

                            @if($errors->has('date'))
                                <div class="alert alert-danger mt-2" role="alert">
                                    <ul class="m-0">
                                    @foreach($errors->get('date') as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="description">Beschreibung</label>
                            <input type="text" name="description" id="description"
                            class="form-control"
                            value="{{old('description') ? old('description') : ''}}">
                            @if($errors->has('description'))
                                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                    <ul class="m-0">
                                        @foreach($errors->get('description') as $error)
                                        <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="working_ticket">Ticket <p class="text-muted d-inline">Optional</p></label>

                            <select name="working_ticket" id="working_ticket" class="custom-select form-control">
                                <option value="" {{old('working_ticket') ? old('working_ticket') === "" ? "selected" : '': ''}}>Keines</option>
                                @foreach ($working_tickets as $ticket)
                                <option value="{{$ticket->id}}" {{old('working_ticket') ? $ticket->id == old('working_ticket')? "selected" : '': ''}}>{{$ticket->name}}</option>
                                @endforeach
                            </select>

                            @if($errors->has('working_ticket'))
                                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <ul class="m-0">
                                        @foreach($errors->get('working_ticket') as $error)
                                        <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        </div>
                        <button type="submit" class="form-control btn btn-success">
                            <i class="fa fa-plus"></i> Hinzufügen
                        </button>
                        {{ csrf_field() }}
                    </form>

                </div>

                <div class="col-md-12 mt-4">
                    <p class="text-muted">Gesamt {{round($working_times->sum('working_time')/60 ,2)}} Stunden</p>
                    <ul class="list-group">
                        <li class="list-group-item p-1 d-flex">
                            <div class="col-lg-2 col-md-2"><p class="m-0">Zeit</p></div>
                            <div class="col-lg-6 col-md-8"><p class="m-0">Beschreibung</p></div>
                            <div class="col-lg-3 d-none d-lg-block"><p class="m-0">Ticket</p></div>
                            <div class="col-lg-1 col-md-2 d-flex"><p class="ml-auto m-0">Bestätigt</p></div>
                        </li>
                        @foreach ($working_times as $job)
                            <li class="list-group-item p-1 d-flex">
                                <div class="col-lg-2 col-md-2">
                                    {{$job->working_time}}
                                </div>
                                <div class="col-lg-6 col-md-8">
                                    {{$job->description}}
                                </div>
                                <div class="col-md-3 d-none d-lg-block">
                                    @if($job->working_ticket)
                                        {{$job->working_ticket->name}}
                                    @else
                                        -
                                    @endif

                                </div>
                                <div class="col-lg-1 d-flex col-md-2">
                                    @if($job->confirmed)
                                        <i class="fa align-self-start fa-check btn btn-success ml-auto"></i>
                                    @else
                                        <i class="fa align-self-start fa-times btn btn-danger ml-auto"></i>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    @if($working_times->count())
                        {{ $working_times->links('layouts.paginator')}}
                    @else
                        <p class="mt-4 text-center">Du hast noch keine Arbeitszeiten eingetragen.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
