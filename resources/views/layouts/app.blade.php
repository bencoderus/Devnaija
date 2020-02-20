<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('images/logo1.png')}}" alt="">

            </a>
                <button class="navbar-toggler" style="border: none !important;" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <i class="fa fa-navicon text-white"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                                     <li class="nav-item active">
                                      <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                      <a class="nav-link" href="/about">About</a>
                                    </li>
                                    <li class="nav-item">
                                      <a class="nav-link" href="/forum">Forum</a>
                                    </li>
                                    <li class="nav-item">
                                            <a class="nav-link" href="/trending">Trending</a>
                                          </li>
                                          <li class="nav-item">
                                            <a class="nav-link" href="/contact">Contact Us</a>
                                          </li>

                                  </ul>
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
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                     {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/account">Account</a>
                                    @auth
                                    @if(auth()->user()->level ==3)
                                    <a class="dropdown-item" href="/admin">Admin</a>
                                    @endif
                                    @endauth

                                    <a class="dropdown-item text-dark" href="{{ route('logout') }}"
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
            </div>
        </nav>
<br>
        <main class="container">
            <div class="row">
            <div class="col-md-9 col-lg-9">
            @include('inc.msgs')
            @yield('content')
       <br><br>
        </div>
        <div class="col-md-3 col-lg-3">
            @include('inc.sidebar')
        </div>
    </div>
        </main>
        @include('inc.footer')


    </div>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
</body>

</html>
