@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item"><a href="/forum">Forum</a></li>
        <li class="breadcrumb-item active" aria-current="page">Search</li>
        </ol>
      </nav>

<p class="maintext">SEARCH FORUM</p><hr>
<br>
@if(session('search'))
@php
$search = session('search');
$results = App\Thread::where('title', 'like', '%'.$search.'%')->orderBy('views', 'DESC')->get();
@endphp
<div class="card">
        <div class="card-header text-capitalize">
        {{session('search')}} search result <p class="pull-right">{{count($results)}} Found</p>
                 </div>
        <div class="card-body">

@if (count($results) > 0)

@foreach($results as $thread)
<a href="/thread/{{$thread->id}}">{{$thread->title}}</a>
<hr>
@endforeach


@else
<div class="text-center">
<i class="fa fa-search text-primary fa-3x mb-2"></i><br><br>
<p class="text-uppercase">NOTHING WAS FOUND RELATED TO {{$search}}</p>
</div>
@endif
</div>
</div><br>
@endif
<div class="card">
    <div class="card-header">
Search
    </div>
    <div class="card-body">
<p>Looking for something?</p>
{{Form::open(['action'=>'ThreadController@find', 'method'=>'POST'])}}
<div class="form-group">
{{Form::search('search', '', ['class'=>'form-control', 'placeholder'=>'Search'])}}
</div>
{{Form::button('
<i class="fa fa-search"></i> Search', ['class'=>'btn btn-primary', 'type'=>'submit'])}}
{{Form::close()}}
    </div>
</div>
@endsection
