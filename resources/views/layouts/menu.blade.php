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
                    <a class="nav-link {{Request::route()->getName() == 'working_time_manage' ? 'active' : ''}}" href="{{route('working_time_manage')}}">Arbeitszeitbestädigung</a>
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

        </ul>


        <ul class="navbar-nav">
            <li class="nav-item d-none d-lg-block">
                <p class="nav-link m-0 mr-2 p-0">{{Auth::user()->name}}</p>
            </li>
            <li class="nav-item">
                <form method="post" action="{{route('logout')}}">
                    {{ csrf_field() }}
                    <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-sign-out"></i> Abmelden</button>
                </form>
            </li>
        </ul>
</nav>
