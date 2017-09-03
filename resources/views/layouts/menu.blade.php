<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <a class="navbar-brand" href="{{route('home')}}">Maturamanager</a>
    <p class="d-lg-none navbar-brand text-muted ml-auto m-0 p-0 mr-2">{{Auth::user()->name}}</p>
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
