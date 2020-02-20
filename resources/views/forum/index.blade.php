@extends('layouts.app')


@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Forum</li>
    </ol>
  </nav>

<p class="lead text-primary font-weight-bold">FORUMS</p>
<hr>
@if(count($secs) > 0)
@foreach($secs as $sec)
@if($sec->forum->count() > 0)
<div class="card mb-2">
<div class="card-header">
<b>{{$sec->name}}</b>
</div>
<div class="card-body">
@foreach($sec->forum as $forum)
<p><a href="/forum/{{$forum->slug}}">{{$forum->name}}</a> <span class="pull-right">{{$forum->thread->count()}} Threads</span>
    </p><hr>



@endforeach
</div>
</div>
@endif
@endforeach
@else
<h3>NO FORUM/SECTION HAS BEEN CREATED YET!</h3>

@endif
@endsection
