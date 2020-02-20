<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<title>
@yield('pagetitle')
</title>
</head>
<body>
<div id="app">
<div class="container-fluid" id="wrapper">
<div class="row">
<nav class="sidebar col-xs-12 col-sm-4 col-lg-3 col-xl-2">
<h1 class="site-title"><a href="/"><img src="{{asset('images/logo.png')}}" alt=""> {{config('app.name')}} </a></h1>

<a href="#menu-toggle" class="btn" id="menu-toggle"><em class="fa fa-bars"></em></a>
<ul class="nav nav-pills flex-column sidebar-nav">
<li class="nav-item"><a class="nav-link {{Request::path()=="admin" ? 'active' : ''}}" href="/admin"><em class="fa fa-dashboard"></em> Dashboard</a></li>
<li class="nav-item"><a class="nav-link {{Request::path()=="admin/section" ? 'active' : ''}}" href="/admin/section"><em class="fa fa-folder"></em> Sections</a></li>
<li class="nav-item"><a class="nav-link {{Request::path()=="admin/forum" ? 'active' : ''}}" href="/admin/forum"><em class="fa fa-comment"></em> Forum</a></li>
<li class="nav-item"><a class="nav-link {{Request::path()=="admin/thread" ? 'active' : ''}}" href="/admin/thread"><em class="fa fa-commenting"></em> Threads</a></li>
<li class="nav-item"><a class="nav-link {{Request::path()=="admin/post" ? 'active' : ''}}" href="/admin/post"><em class="fa fa-comments"></em> Posts</a></li>
<li class="nav-item"><a class="nav-link {{Request::path()=="admin/users" ? 'active' : ''}}" href="/admin/users"><em class="fa fa-users"></em> Users</a></li>
<li class="nav-item"><a class="nav-link {{Request::path()=="admin/sendbc" ? 'active' : ''}}" href="/admin/sendbc"><em class="fa fa-envelope"></em> Send broadcast</a></li>

<li class="nav-item"><a class="nav-link" href="/logout"><em class="fa fa-tag"></em> Signout </a></li>
</ul>
</nav>
<main class="col-xs-12 col-sm-8 col-lg-9 col-xl-10 pt-3 pl-4 ml-auto">
@yield('content')
</main>
@include('inc.adminfooter')
<br><br>


</div>
</body>

</html>

<script>
$("#menu-toggle").click(function(e) {
e.preventDefault();
$("#wrapper").toggleClass("toggled");
});

</script>
