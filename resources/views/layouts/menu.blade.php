<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <a class="navbar-brand" href="{{route('home')}}">Maturamanager</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{Request::route()->getName() == 'home' ? 'active' : ''}}">
                <a class="nav-link" href="{{route('home')}}">Home</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{Request::route()->getName() == 'working_times' ? 'active' : ''}}" href="{{route('working_times')}}">Arbeitszeit</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{Request::route()->getName() == 'working_tickets' ? 'active' : ''}}" href="{{route('working_tickets')}}">Tickets</a>
            </li>

            @can('working_time', Auth::user())
                <li class="nav-item">
                    <a class="nav-link {{Request::route()->getName() == 'working_time_manage' ? 'active' : ''}}" href="{{route('working_time_manage')}}">Arbeitszeitbestätigung</a>
                </li>
            @endcan

            @can('user', Auth::user())
                <li class="nav-item">
                    <a class="nav-link {{Request::route()->getName() == 'user' ? 'active' : ''}}" href="{{route('user')}}">Nutzer</a>
                </li>
            @endcan

            @can('superadmin', Auth::user())
                <li class="nav-item">
                    <a class="nav-link {{Request::route()->getName() == 'roles' ? 'active' : ''}}" href="{{route('roles')}}">Berechtigungen</a>
                </li>
            @endcan

            @can('cleanup_person', Auth::user())
                <li class="nav-item">
                    <a class="nav-link {{Request::route()->getName() == 'cleanup_person' ? 'active' : ''}}" href="{{route('cleanup_person')}}">Aufräumdienst</a>
                </li>
            @endcan

            @can('manage_tickets', Auth::user())
                <li class="nav-item">
                    <a class="nav-link {{Request::route()->getName() == 'ticket_manage' ? 'active' : ''}}" href="{{route('ticket_manage')}}">Tickets Verwalten</a>
                </li>
            @endcan


            <li class="nav-item d-lg-none">
                <a class="nav-link" href="{{route('user_settings', Auth::user()->slug)}}">Passwort ändern</a>
            </li>
            <li class="nav-item d-lg-none">
                <form method="post" action="{{route('logout')}}" class="nav-link">
                    {{ csrf_field() }}
                    <button class="btn btn-primary btn-sm form-control" type="submit"><i class="fa fa-sign-out"></i> Abmelden</button>
                </form>
            </li>

        </ul>


        <ul class="navbar-nav">
            <li class="nav-item d-none d-lg-block">
                <div class="dropdown show">
                    <a class="btn btn-info btn-sm dropdown-toggle mr-2" href="#" role="button" id="profile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{Auth::user()->name}}
                    </a>

                    <div class="dropdown-menu" aria-labelledby="profile">
                        <a class="dropdown-item" href="{{route('user_settings', Auth::user()->slug)}}">Passwort ändern</a>
                        <form method="post" action="{{route('logout')}}" class="dropdown-item">
                            {{ csrf_field() }}
                            <button class="btn btn-primary btn-sm form-control" type="submit"><i class="fa fa-sign-out"></i> Abmelden</button>
                        </form>
                    </div>
                </div>
            </li>
        </ul>
</nav>
