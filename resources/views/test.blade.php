@extends('layouts.app')

@section('content')

<p class="maintext text-uppercase">TOP CONTRIBUTORS</p>
@if(count($users) > 0)

@foreach($users as $user)
<p>{{$user->name}} - {{$user->thread->count()}}</p>
@endforeach
@else
<br>
<p class="h2">NO TRENDING POST YET</p>
@endif



<p class="maintext text-uppercase">TOP FORUMS</p>
@if(count($threads) > 0)

@foreach($threads as $thread)
<p>{{$thread->title}} - {{$thread->post->count()}}</p>
@endforeach
@else
<br>
<p class="h2">NO TRENDING POST YET</p>
@endif

@endsection
