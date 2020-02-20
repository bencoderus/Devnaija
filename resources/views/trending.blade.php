@extends('layouts.app')

@section('content')

<p class="maintext text-uppercase">TRENDING ON {{config('app.name')}}</p>
@if(count($threads) > 0)
<div class="row card-desk">

@foreach($threads as $thread)
<div class="col-md-6">
<div class="card">
          <img class="card-img-top" src="/storage/uploads/{{$thread->photo}}" alt="Preview">
          <div class="card-body"><a href="/thread/{{$thread->slug}}"><h5 class="card-title">{{$thread->title}}</h5></a>
          <p class="card-text">{!!str_limit($thread->post->first()->message, 100)!!}</p></div>
            <div class="card-footer">
          <p class="card-text"><small class="text-muted">Added: {{$thread->created_at->diffForHumans()}}</small></p>
          </div>
        </div></div>
<br>

@endforeach
</div>
@else
<br>
<p class="h2">NO TRENDING POST YET</p>
@endif
    @endsection
