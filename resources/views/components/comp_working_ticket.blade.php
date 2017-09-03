<div class="col-md-6 col-lg-4 pb-4">
    <div class="card" style="height: 100%">
        <div class="card-body">
            @isset($ticket->thumbnail)
                //Platzhalter
                {{$ticket->thumbnail}}
            @endisset
            <h4 class="card-title d-flex">{{$ticket->name}}
                <div class="ml-auto align-self-start d-flex">
                    <button class="btn {{$ticket->completed ? 'btn-success' : 'btn-danger'}}">
                        @if($ticket->completed)
                            <i class="fa fa-check"></i>
                        @else
                            <i class="fa fa-cogs"></i>
                        @endif
                    </button>
                </div>
            </h4>
            <p class="card-text">{{$ticket->description}}</p>

            <a class="btn btn-primary" data-toggle="collapse" href="#users{{$ticket->id}}" aria-expanded="false" aria-controls="users">
              Personen <i class="fa fa-caret-down"></i>
            </a>

            <div class="collapse" id="users{{$ticket->id}}">
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
                            <form class="ml-auto" action="{{route('working_tickets_remove_user', [$ticket->id, $user->slug])}}" method="post">
                                <button type="submit" class="btn btn-danger" {{$ticket->author->slug == $user->slug ? "disabled" : "" }}><i class="fa fa-trash"></i></button>
                                {{ csrf_field() }}
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="card-footer text-muted">
          <a href="{{route('user_show', $ticket->author->slug)}}">{{$ticket->author->name}}</a> {{$ticket->created_at->diffForHumans()}}
        </div>
    </div>
</div>
