<div class="col-md-6 col-lg-4 pb-4">
    <div class="card h-100" >
        <div class="card-body">
            @isset($ticket->thumbnail)
                //Platzhalter
                {{$ticket->thumbnail}}
            @endisset
            <h4 class="card-title d-flex">{{$ticket->name}}
                <div class="ml-auto align-self-start d-flex">
                    @if($ticket->completed)
                        @if(Auth::user()->id === $ticket->author->id)
                            <form action="{{route('working_tickets_uncompleted_status', $ticket->id)}}" method="post">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-check"></i>
                                </button>
                                {{ csrf_field() }}
                                {{method_field('PUT')}}
                            </form>
                        @else
                            <div class="btn btn-success">
                                <i class="fa fa-check"></i>
                            </div>
                        @endif
                    @else
                        @if(Auth::user()->id === $ticket->author->id)
                            <form action="{{route('working_tickets_completed_status', $ticket->id)}}" method="post">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-cogs"></i>
                                </button>
                                {{ csrf_field() }}
                                {{method_field('PUT')}}
                            </form>
                        @else
                            <div class="btn btn-danger">
                                <i class="fa fa-cogs"></i>
                            </div>
                        @endif
                    @endif
                </div>
            </h4>

            <ticket-description :ticket-prop="{{json_encode($ticket)}}"></ticket-description>

            <a class="btn btn-primary" data-toggle="collapse" href="#users{{$ticket->id}}" aria-expanded="{{request()->has('ticket_opened') ? request()->get('ticket_opened') == $ticket->id ? 'true' : 'false' : 'false'}}" aria-controls="users">
              Personen <i class="fa fa-caret-down"></i>
            </a>

            <div class="collapse {{request()->has('ticket_opened') ? request()->get('ticket_opened') == $ticket->id ? 'show' : '' : ''}}" id="users{{$ticket->id}}">
                @can('add_user', $ticket)
                    <form action="{{route('working_tickets_add_user', $ticket->id)}}" method="post">
                        <div class="input-group mt-2">
                            <select class="custom-select custom-select-left form-control" name="user_id">
                                @foreach ($addable_users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="input-group-addon"><i class="fa fa-plus"></i></button>
                        </div>
                        {{ csrf_field() }}
                    </form>
                @endcan
                <ul class="list-group my-2">
                    @foreach ($ticket->users as $user)
                        <li class="list-group-item d-flex">
                            <a href="{{route('user_show', $user->slug)}}">{{$user->name}}</a>

                            @can('remove_user', $ticket)
                                <form class="ml-auto" action="{{route('working_tickets_remove_user', [$ticket->id, $user->slug])}}" method="post">
                                    <button type="submit" class="btn btn-danger" {{$ticket->author->slug == $user->slug ? "disabled" : "" }}><i class="fa fa-trash"></i></button>
                                    {{ csrf_field() }}
                                </form>
                            @endcan
                        </li>
                    @endforeach
                </ul>
            </div>

            <p class="text-muted mt-4">Du hast {{round($ticket->user_worked_time_on_ticket(Auth::user())/60, 2)}} Stunden an diesem Ticket mitgearbeitet.</p>
        </div>

        <div class="card-footer text-muted">
          <a href="{{route('user_show', $ticket->author->slug)}}">{{$ticket->author->name}}</a> {{$ticket->created_at->diffForHumans()}}
        </div>
    </div>
</div>
