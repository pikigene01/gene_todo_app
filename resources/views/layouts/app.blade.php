<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('assets/css/app.v2.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assetscss/font.css') }}" type="text/css" cache="false" />
    <title>Gene ToDo App</title>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>

    <meta name="keywords" content="Connectcurb  API" />
</head>
<style type="text/css">
.btn{
    margin-bottom: 20px;
}
</style>

<body class="antialiased common-home">

    @if(Session::has('message'))
        <div class="alert alert-warning">
            {{Session::get('message')}}
        </div>
    @endif

    @yield('content')

    <script src='{{ asset("assets/js/app.v2.js") }}''></script>
    <!-- Bootstrap -->
    <!-- App -->
    <script src="{{ asset('assets/js/libs/underscore-min.js') }}"></script>
    <script src="{{ asset('assets/js/libs/backbone-min.js') }}"></script>
    <script src="{{ asset('assets/js/libs/backbone.localStorage-min.js') }}"></script>
    <script src="{{ asset('assets/js/libs/moment.min.js') }}"></script>
    <!-- Tasks -->
    <script src="{{ asset('assets/js/apps/tasks.js') }}" cache="false"></script>
</body>

</html>
