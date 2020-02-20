@extends('layouts.app')

@section('content')

<h3 class="text-uppercase">YOU ARE QUOTING {{$post->user}}</h3>
<br><br>
<div class="card">
    <div class="card-header">Enter your reply to the quote</div>
    <div class="card-body">
    {!!$post->message!!}

            {{Form::open(['action'=>'PostController@quotereply', 'method'=>'POST', 'enctype'=>'multipart/form-data'])}}
        <div class="form-group">
             {{Form::label('Message: ')}}
            <br>{{Form::textarea('message', '', ['class'=>'form-control', 'id'=>'article-ckeditor'])}}
        </div>
        {{ Form::hidden('qid', $post->id) }}
        {{ Form::hidden('qmessage', $post->message) }}
        {{Form::hidden('quser', $post->user)}}
        {{ Form::hidden('tid', $post->thread->id) }}
        <div class="form-group">
        {{Form::button('<i class="fa fa-edit"></i> Update changes', ['class'=>'btn btn-primary', 'type'=>'submit'])}}
    </div>
        {{Form::close()}}

    </div>
</div>
@endsection
