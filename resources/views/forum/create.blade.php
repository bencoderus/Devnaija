@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item"><a href="/forum">Forum</a></li>
     <li class="breadcrumb-item"><a href="/forum/{{$forum->id}}">{{$forum->name}}</a></li>
      <li class="breadcrumb-item active" aria-current="page">Create a new thread</li>
    </ol>
  </nav>


<h3 class="text-primary">
{{$forum->name}}
</h3><hr>
<p>Create new thread.
    </p>


    {{Form::open(['action'=>'ThreadController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data'])}}
    <div class="form-group">
    {{Form::label('Title: ')}}
    <br>
    {{Form::text('title', '', ['class'=>'form-control'])}}
</div>
<div class="form-group">
        {{Form::label('Body: ')}}
    <br>{{Form::textarea('body', '', ['class'=>'form-control', 'id'=>'article-ckeditor'])}}
</div>
<div class="form-group">
        {{Form::label('Attachment (Optional): ')}}
    {{Form::file('image')}}
</div>
    {{Form::hidden('forumid', $forum->id)}}
    {{Form::hidden('author', auth()->user()->name)}}
    <div class="form-group">
    {{Form::button(' Create Thread', ['class'=>'btn btn-block btn-primary', 'type'=>'submit'])}}
</div>
    {{Form::close()}}
<br>
@endsection
