@extends('layouts.admin')


@section('pagetitle')
Posts - Admin
@endsection

@section('content')
<p class="maintext">SEND BROADCAST
<hr>
</p>

<br>
<div class="card">
<div class="card-header">Send Broadcast <b class="float-right">You are sending message as {{auth()->user()->name}}</b></div>
<div class="card-body">
{{Form::open(['method'=>'POST', 'action'=>'AdminController@sendbc'])}}

<div class="form-group">
{!! Form::label('Type your message:') !!}
{!! Form::textarea('message', '', ['class'=>'form-control', 'required', 'minlength'=>'5']) !!}
</div>

<div class="form-group">
{!! Form::submit('Send broadcast', ['class'=>'btn btn-primary btn-block']) !!}
    </div>


{{Form::close()}}
</div>
</div>
@endsection
