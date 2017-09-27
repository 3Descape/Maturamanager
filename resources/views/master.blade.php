<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
</head>
<body>
    <div class="container-fuid" id="app">
        @yield('content')
    </div>

    <footer>
        <script src="{{asset('/js/app.js')}}"></script>
        <script type="text/javascript">
            var auth = {!!json_encode(Auth::user())!!}
        </script>
    </footer>
</body>
</html>
