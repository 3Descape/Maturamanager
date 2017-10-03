@extends('master')
@section('title')
    Meine Tickets
@endsection
@section('content')
    @include('layouts.menu')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-sm-11 mx-auto row">
                <div class="col-md-12 d-flex">
                    <h2>Für mich relevante Tickets:</h2>
                    <a href="{{route('working_tickets_overview')}}" class="btn btn-primary ml-auto">
                        <i class="fa fa-arrow-right"></i> Alle ansehen
                    </a>
                </div>
                <div class="col-md-12 mt-4 mb-4">
                    <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#add-working_ticket" aria-expanded="{{$errors->any() ? 'true' : 'false'}}" aria-controls="add-working_ticket">
                        Neues Ticket <i class="fa fa-caret-down"></i>
                    </button>
                </div>
                <div class="{{$errors->any() ? 'show' : 'collapse'}} col-md-12" id="add-working_ticket">
                    <form action="{{route('working_tickets_store')}}" method="post" class="mb-5">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control" required>

                            @if($errors->has('name'))
                                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                    <ul class="m-0">
                                    @foreach($errors->get('name') as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="description">Beschreibung</label>
                            <input type="text" name="description" id="description" value="{{old('description')}}" class="form-control">

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
                        <button type="submit" class="form-control btn btn-success"><i class="fa fa-plus"></i> Hinzufügen</button>
                        {{ csrf_field() }}
                    </form>
                </div>

                @foreach ($working_tickets as $ticket)
                    {{-- @component('components.comp_working_ticket', ['ticket' => $ticket, 'addable_users' => $users->diff($ticket->users)])
                    @endcomponent --}}

                    <workingticket :ticket-prop="{{$ticket}}" :users-to-add-prop="{{$users->diff($ticket->users)}}" :auth-user-prop="{{Auth::user()}}"></workingticket>
                @endforeach
            </div>
        </div>

    </div>
@endsection
