@extends('layouts.app')

@section('content')

<p class="text-center">
<img src="/storage/usersphoto/{{mydp($user->name)}}" alt="avatar" class="rounded-circle" style="width: 20%">
</p>
<p class="text-center maintext text-dark">{{ucwords($user->name)}}</p>
<p class="text-center text-muted">{{checklevel($user->level)}}</p><br>

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">About</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Threads ({{$threads->count()}})</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Posts ({{$posts->count()}})</a>
    </li>
  </ul>
  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
{{--About user--}}
<div class="card"><div class="card-body">
<p><b class="text-primary">Name:</b> {{ucwords($user->name)}} </p><hr>
<p><b class="text-primary">Level:</b> {{checklevel($user->level)}} </p><hr>
<p><b class="text-primary">Bio:</b> {{$user->bio}} </p><hr>
    <p><b class="text-primary">Contributions:</b> {{$user->thread->count()+$user->post->count()}}</p><hr>
    <p><b class="text-primary">Upvotes:</b> {{$user->like->count()}} </p><hr>
    @isset($user->last_seen)
    <p><b class="text-primary">Last Seen:</b> {{$user->last_seen}} </p><hr>
    @endisset
    <p><b class="text-primary">Joined:</b> {{$user->created_at->diffForHumans()}} </p>
    </div>
</div>
</div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        @if(count($threads) > 0)
        @foreach($threads as $thread)
        <div class="card">
            <div class="card-body"><a href="/thread/{{$thread->id}}">{{$thread->title}}</a></div>
        </div><br>

        @endforeach
        @else
        <h5>{{$user->name}} has not posted any thread yet</h5>
        @endif

    </div>
    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">

        @if(count($posts) > 0)
        @foreach($posts as $post)
        <div class="card">
        <div class="card-body">{{$user->name}} just replied <a href="/thread/{{$post->thread->id}}#p{{$post->id}}">{{$post->thread->title}}</a> - {{$post->created_at->diffForHumans()}}</div>
        </div>
<br>
        @endforeach
        @else
        <h5>{{$user->name}} has not posted anything yet</h5>
        @endif


    </div>
  </div><br>
  @if(auth()->user()->id != $user->id)
  <center>
  <a href="/message/send/{{$user->name}}" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Message {{$user->name}}</a>
</center>
@endif
@endsection
