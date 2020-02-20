@extends('layouts.app')

@section('content')

<p class="maintext text-uppercase">NOTIFICATIONS</p><hr>


<ul class="list-group">
    <li class="list-group-item active">My Notifications</li>

@if(count($notify) > 0)

@foreach($notify as $not)


<li class="list-group-item">
    @if($not->read == 1)

    {{$not->message}} <small class="text-muted">- {{$not->created_at->diffForHumans()}}</small>
@else
<b>{{$not->message}} <small class="text-muted">- {{$not->created_at->diffForHumans()}}</small></b>
@endif
</li>

@endforeach
@else
<li class="list-group-item">No new notification yet</li>
@endif



  </ul>

@endsection
