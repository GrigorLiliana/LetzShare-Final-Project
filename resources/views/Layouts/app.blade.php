<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LetzShare') }}</title>


    <!-- Scripts -->
    <script
      type="text/javascript"
      src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"
    ></script>
    <script src="https://kit.fontawesome.com/ff9603d652.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/letzshare.js') }}" defer></script>
    <script src="{{ asset('js/modernizr-custom.js') }}"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/letzshare.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">

        @include('layouts.nav')

        <main class="py-4">
            @yield('content')
        </main>
    </div>

@include('layouts.footer')

</body>
</html>
