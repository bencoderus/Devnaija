@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item"><a href="/message">Message</a></li>
      <li class="breadcrumb-item active" aria-current="page">Compose message</li>
    </ol>
  </nav>

<div class="card">
<div class="card-header">
Send Message
</div>
<div class="card-body">
{{Form::open(['action'=>'MessageController@store', 'method'=>'POST'])}}
<div class="form-group">
{{Form::label('User: ')}}
{{Form::text('user', '@' .$name, ['class'=>'form-control', 'placeholder'=>'@username'])}}
</div>

<div class="form-group">
    {{Form::label('Message: ')}}
    {{Form::textarea('message', '', ['class'=>'form-control', 'placeholder'=>'Type message'])}}
    </div>
{{Form::hidden('sender', auth()->user()->name)}}
  <div class="text-center">
        {{Form::submit('Send message', ['class'=>'btn btn-block btn-primary'])}}
        </div>

{{Form::close()}}
</div>
</div>

    @endsection
