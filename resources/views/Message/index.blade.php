@extends('layouts.app')


@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Messaging</li>
    </ol>
  </nav>

<p class="maintext">MESSAGING</p><hr>
@php
$count = App\Message::where('receiver', auth()->user()->name)->where('read', 0)->count();
@endphp

<ul class="list-group">
    <li class="list-group-item active">Manage Messages</li>

    <li class="list-group-item"><a href="/message/send">Compose Message</a></li>
    <li class="list-group-item"><a href="/message/unread">Unread Messages</a> <span class="pull-right badge badge-primary">{{$count}}</span></li>
    <li class="list-group-item"><a href="/message/inbox">Inbox</a></li>
    <li class="list-group-item"><a href="/message/sent">Sent Message</a></li>
  </ul>


@endsection
