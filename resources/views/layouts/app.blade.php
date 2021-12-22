<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="client">
        <main class="py-4">
            @yield('content')
        </main>
        <footer>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="cutaway-info-description">
                        <ul class="nav-bottom">
                            @auth
                                @if (Auth::user()->isAdmin)
                                    <li>
                                        <a href="{{ route('admin.dashboard') }}">Админ панель</a>
                                    </li>
                                @endif
                                <li>
                                    <a class="" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        Выйти
                                    </a>
                                </li>
                            @endauth
                        </ul>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
