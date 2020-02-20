@extends('layouts.app')

@section('content')



<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item"><a href="/forum">Forum</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$forum->name}}</li>
    </ol>
  </nav>


<h3 class="lead font-weight-bold text-primary">
{{$forum->name}}
</h3>
<small></small>{{$forum->description}} [{{$thread->count()}} Threads]</small><hr>
<a href="/forum/create/{{$forum->id}}" class="btn btn-sm btn-primary font-weight-bold"><i class="fa fa-plus"></i> NEW THREAD</a>


<br><br><br>
@if(count($thread) < 1)
<div class="card"><div class="card-body h5">
No thread has been posted yet!</div>
</div>
@else
@foreach($thread as $thread)
<div class="card mb-2">
    <div class="card-header">
            <a href="/thread/{{$thread->slug}}" class="font-weight-bold">{{$thread->title}} ({{count($thread->post)}})</a></div>
    <div class="card-body">

        <p>Author: {{$thread->author}}, Added: {{$thread->created_at->diffForHumans()}}</p>
        <p>Views: {{$thread->views}} </p>
</div>
</div>
@endforeach
<br>
@endif

@endsection
