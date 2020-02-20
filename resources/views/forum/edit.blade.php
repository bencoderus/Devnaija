@extends('layouts.app')

@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item"><a href="/forum">Forum</a></li>
     <li class="breadcrumb-item"><a href="/forum/{{$thread->forum->id}}">{{$thread->forum->name}}</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit {{$thread->title}}</li>
    </ol>
  </nav>

<p class="maintext text-uppercase">
EDIT THREAD
</p> <small>{{$thread->title}}</small>
<br><br>
<div class="card mb-2">
    <div class="card-header">Edit Thread</div>
    <div class="card-body">    {{Form::open(['action'=>'ThreadController@update', 'method'=>'POST', 'enctype'=>'multipart/form-data'])}}
        <div class="form-group">
        {{Form::label('Title: ')}}
        <br>
        {{Form::text('title', $thread->title, ['class'=>'form-control'])}}
    </div>
    <div class="form-group">
            {{Form::label('Message: ')}}
        <br>{{Form::textarea('body', $post->message, ['class'=>'form-control', 'id'=>'article-ckeditor'])}}
    </div>
    <div class="form-group">
            {{Form::label('Attachment (Optional): ')}}
        {{Form::file('image')}}
        {{Form::hidden('threadid', $thread->id)}}
        {{Form::hidden('postid', $post->id)}}
    </div>
        <div class="form-group">
        {{Form::button('<i class="fa fa-edit"></i> Update changes', ['class'=>'btn btn-block btn-primary', 'type'=>'submit'])}}
    </div>
        {{Form::close()}}
    <br>
    </div>
</div>
@endsection
