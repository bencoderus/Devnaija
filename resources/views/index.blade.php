@extends('layouts.app')

@section('content')

<p class="maintext text-uppercase">LATEST NEWS</p>
<hr>
@if(count($threads) > 0)
<div class="row card-desk">

@foreach($threads as $thread)
<div class="col-md-6">
<div class="card mb-2 mt-2">
          <img class="card-img-top" src="/storage/uploads/{{$thread->photo}}" alt="Preview">
          <div class="card-body"><a href="/thread/{{$thread->slug}}"><h5 class="card-title">{{$thread->title}}</h5></a>
            <p class="card-text">{!!str_limit($thread->body, 100)!!}</p></div>
            <div class="card-footer">
            <p class="card-text"><small class="text-muted"><i class="fa fa-clock-o"></i> Added: {{$thread->created_at->diffForHumans()}} <i class="fa fa-eye"></i> {{$thread->views}}</small></p>
          </div>
        </div></div>
<br>
<br><br>
@endforeach
</div>
@else
<br>
<p class="h2">NO TRENDING POST YET</p>
@endif
    @endsection
