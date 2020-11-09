<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PetsGram | @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body
    class="{{ Request::path() == 'login' ? 'login-bg' : '' }} {{ Request::path() == 'register' ? 'register-bg' : '' }}">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">

                @if (Route::has('login'))
                @auth
                <a class="navbar-brand d-flex" href="/">
                    <div><img src="/images/petsGram.svg" style="height: 25px; border-right: 1px solid #333"
                            class="pr-3"></div>
                    <div class="pl-3 pt-1"> PetsGram</div>
                </a>
                @else
                <a class="navbar-brand d-flex" href="/">
                    <div><img src="/images/petsGram.svg" style="height: 25px; border-right: 1px solid #333"
                            class="pr-3"></div>
                    <div class="pl-3 pt-1"> PetsGram</div>
                </a>
                @endauth

                @endif
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else

                        <a class="d-flex my-auto pt-2 pr-5 pb-2 text-secondary" href="/">Newsfeed</a>

                        <a class="d-flex my-auto pt-2 pr-5 pb-2 text-secondary"
                            href="/profile/{{auth()->user()->username}}">Dashboard</a>

                        <li class="nav-item dropdown d-flex my-auto">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>


    <div class="space"></div>
    <div>
        <footer class="footer">
            <small>2020 &copy; PetsGram Inc</small><br>
            <small>Made with ❤️ </small>
        </footer>
    </div>


    @yield('script')
</body>

</html>