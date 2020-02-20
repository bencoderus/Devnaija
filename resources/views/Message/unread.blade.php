@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item"><a href="/message">Message</a></li>
      <li class="breadcrumb-item active" aria-current="page">Unread messages</li>
    </ol>
  </nav>


<p class="maintext">UNREAD MESSAGES</p><hr>
<div class="card">
<div class="card-header">
Unread messages
</div>

<div class="card-body">
@if(count($msgs) > 0)
@foreach($msgs as $msg)
@php
$count = App\Message::where('sender', $msg->sender)->where('receiver', auth()->user()->name)->where('read', 0)->count();
@endphp

<a href="/message/view/{{$msg->sender}}"><b>{{$msg->sender}}</b></a>
<span class="pull-right badge badge-primary">{{$count}}</span>
<hr>
@endforeach
@else
<h5>No new message yet</h5>
@endif
</div>
</div>
    @endsection
