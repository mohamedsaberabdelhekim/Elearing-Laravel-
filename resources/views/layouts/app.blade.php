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
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}"
                    style="font-size:1.8em ;color: rgba(29, 36, 134, 0.801);font-weight: 600;">
                    ELearning
                </a>
                <a class="navbar-brand" href="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto align-items-center">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="/courses" style="font-size:1.2em ;color:#333;">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/courses" style="font-size:1.2em ;color:#333;">Our
                                    Courses</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/courses" style="font-size:1.2em ;color:#333;">Contact
                                    Us</a>
                            </li>
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}"
                                        style="font-size:1.2em ;color:#333;">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}"
                                        style="font-size:1.2em ;color:#333;">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="/about" style="font-size:1.2em ;color:#333;">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/courses" style="font-size:1.2em ;color:#333;">Our
                                    Courses</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/contact" style="font-size:1.2em ;color:#333;">Contact
                                    Us</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" style="font-size:1.2em ;color:#333;"
                                    href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" v-pre>
                                    <img src="../../../storage/images/{{ auth()->user()->id }}/{{ auth()->user()->image }}"
                                        width="50px" height="50px" style="border-radius: 50%; margin-right:0.3rem" alt="">
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.show', Auth::user()) }}">
                                        My Profile
                                    </a>
                                    @if (Auth::user()->role == 'teacher')
                                        <a class="dropdown-item" href="{{ route('user.courses', Auth::user()) }}">
                                            My Courses
                                        </a>
                                    @endif
                                    @if (Auth::user()->role == 'student')
                                        <a class="dropdown-item" href="{{ route('user.enrollments', Auth::user()) }}">
                                            My Enrollments
                                        </a>
                                    @endif
                                    @if (Auth::user()->role == 'student')
                                        <a class="dropdown-item"
                                            href="{{ route('user.availableCourses', Auth::user()) }}">
                                            Available Courses
                                        </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>


                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>


    </div>
</body>

</html>
