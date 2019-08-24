<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/letzshare.js') }}" defer></script>
    <script src="{{ asset('js/jquery.fancybox.js') }}" defer></script>
    {{-- <script src="{{ asset('js/filters.js') }}" defer></script> --}}
    <script src="https://kit.fontawesome.com/ff9603d652.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/letzshare.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

</head>

<body>

    <div id="app">
        <!-- shadow div (user profile when user send message) -->
        <div class="shadow-div hide"></div>


        @include('layouts.nav')

        <main class="container py-4">
            <!-- div to display errors -->
            <div class="notAdmin">
                @if ( $message = Session::get('error') )
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <span>{{ $message }}</span>
                </div>
                @endif
            </div>

            @yield('content')
        </main>
    </div>

    @include('layouts.footer')

</body>

</html>
