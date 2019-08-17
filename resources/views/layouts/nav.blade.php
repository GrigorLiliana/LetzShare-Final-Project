<header>
    @php
        // navbar active link
        function current_page($uri = '/') {
            return strstr( request()->path(), $uri);
        }
    @endphp
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/') }}/LetzShare_logo.png" alt="LetzShare logo." width="60px">
                    {{ config('app.name', 'LetzShare') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item {{ (current_page('/')) ? 'active' : '' }}">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item {{ (current_page('gallery')) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/gallery') }}">Photo gallery</a>
                        </li>
                        <li class="nav-item {{ (current_page('about-us')) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('about-us') }}">About us</a>
                        </li>
                        <li class="nav-item {{ (current_page('contact')) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                        </li>
                    <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link {{ (current_page('login')) ? 'active' : '' }}" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link {{ (current_page('register')) ? 'active' : '' }}" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('useraccount') }}">
                                        My account
                                    </a>
                                    <a class="dropdown-item" href="{{ route('uploadphoto') }}">
                                        Upload photo
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                </div>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="#upload-photo" class="dropdown-item">Upload a photo</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            
        </nav>
</header>
