<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/6c02b20e8c.js"></script>
    <script>
        window.App = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user' => Auth::user(),
            'signedIn' => Auth::check(),
        ]) !!};
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body { padding: 100px 0; }
        .level { display: flex; align-items: center; }
        .flex{ flex: 1; }
        [v-cloak] { display: none }
        #avatar-input { display: none }
        .ais-highlight em { background: yellow; font-style: normal; }
    </style>

    @yield('header')
</head>
<body>
    <div id="app">
        @include('layouts.nav')

        @yield('content')

        <flash message="{{ session('flash')}}"></flash>
    </div>
</body>
</html>
