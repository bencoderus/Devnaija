@extends('layouts.app')

@section('content')

<p class="maintext text-uppercase">MY ACCOUNT</p><br>
<ul class="list-group">
    <li class="list-group-item active">Manage Account</li>
<li class="list-group-item"><a href="/user/{{auth()->user()->name}}">My profile</a></li>
<li class="list-group-item"><a href="/account/notifications">Notifications</a></li>
<li class="list-group-item"><a href="/account/thread/{{auth()->user()->name}}">My threads</a></li>
    <li class="list-group-item"><a href="#">Update profile</a></li>
    <li class="list-group-item"><a href="/account/changephoto">Change photo</a></li>
    <li class="list-group-item"><a href="#">Change password</a></li>

  </ul>

@endsection
