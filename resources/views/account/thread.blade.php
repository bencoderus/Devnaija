@extends('layouts.app')

@section('content')

<p class="maintext text-uppercase">{{$user->name}} Threads</p>
<hr>
@if(count($thread) < 1)
<div class="text-center"><p class="h5">
{{$user->name}} has posted any thread yet.</p>
</div>
@else

@foreach($thread as $thread)
<div class="card">
    <div class="card-body">
            <a href="/thread/{{$thread->id}}" class="font-weight-bold">{{$thread->title}} ({{count($thread->post)}})</a>
</div>
</div><br>
@endforeach
<br>
@endif
@endsection
