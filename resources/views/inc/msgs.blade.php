
@if(session('success'))
<div class="alert alert-success"> {{session('success')}} </div>
@endif

@if(session('error'))
<div class="alert alert-danger"> {{session('error')}} </div>
@endif

@if(count($errors) > 0)
@foreach($errors->all() as $error)
<div class="alert alert-danger">
{{$error}}
</div><br>
@endforeach
@endif


@auth
@php
$msgcount = App\Message::where('receiver', auth()->user()->name)->where('read', 0)->count();
$notcount = App\Notification::where('user', auth()->user()->name)->where('read', 0)->count();
@endphp


@if($msgcount > 0)
<div class="alert alert-main alert-dismissible fade show" role="alert"> <i class="fa fa-envelope"></i>
<a href="/message/unread" class="text-white"><strong> You have {{$msgcount}} new @if($msgcount > 1) messages @else message @endif</strong></a>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif


@if($notcount > 0)
<div class="alert alert-main alert-dismissible fade show" role="alert"> <i class="fa fa-envelope"></i>
<a href="/account/notifications" class="text-white"><strong> You have {{$notcount}} new {{($notcount > 1) ? "notifications" : "notification"}}</strong></a>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif

@endauth
