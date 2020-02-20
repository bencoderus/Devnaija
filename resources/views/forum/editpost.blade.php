@extends('layouts.app')

@section('content')

<p class="maintext text-uppercase">EDIT post</p>
<br><br>
<div class="card mb-2">
    <div class="card-header">Edit my post</div>
    <div class="card-body">
            {{Form::open(['action'=>'PostController@update', 'method'=>'POST', 'enctype'=>'multipart/form-data'])}}
        <div class="form-group">
             {{Form::label('Message: ')}}
            <br>{{Form::textarea('message', $post->message, ['class'=>'form-control', 'id'=>'article-ckeditor'])}}
        </div>
        {{ Form::hidden('cid', $post->id) }}
        {{ Form::hidden('tid', $post->thread->id) }}
        <div class="form-group">
        {{Form::button('<i class="fa fa-edit"></i> Update changes', ['class'=>'btn btn-primary', 'type'=>'submit'])}}
    </div>
        {{Form::close()}}

    </div>
</div>
@endsection
