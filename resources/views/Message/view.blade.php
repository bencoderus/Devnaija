@extends('layouts.app')

@section('content')

<p class="maintext text-uppercase">{{$name}} CONVERSATION <span class="pull-right">{{$msgs->count()}}</span></p><hr>
@if(count($msgs) > 0)

@foreach($msgs as $msg)
    @if($msg->sender==auth()->user()->name)
    <div class="row justify-content-start">
        <div class="col-md-7">

            <div class="chat1 p-3" id="m{{$msg->id}}"><img src="/storage/usersphoto/{{mydp($msg->sender)}}" alt="avatar" class="rounded-circle" style="width: 8%">
                {{$msg->message}}
                <p class="m-2 float-right">
                    <small>{{$msg->created_at->diffForHumans()}}</small></div>
                </p>

        </div>
    </div>
    @elseif($msg->sender != auth()->user()->name)
<div class="row justify-content-end">
    <div class="col-md-7">
        <div class="chat2 p-3" id="m{{$msg->id}}"><img src="/storage/usersphoto/{{mydp($msg->sender)}}" alt="avatar" class="rounded-circle" style="width: 8%">
            {{$msg->message}}
            <p class="m-2 float-right">
                <small>{{$msg->created_at->diffForHumans()}}</small></div>
            </p>

    </div>
</div>

    @endif
@endforeach
@else
<h5>No new message yet</h5>
@endif

{{Form::open(['action'=>'MessageController@store', 'method'=>'POST'])}}
<div class="form-group">
    {{Form::textarea('message', '', ['class'=>'form-control', 'placeholder'=>'Type your message', 'required'=>'required'])}}
    </div>
{{Form::hidden('sender', auth()->user()->name)}}
{{Form::hidden('user', $name)}}
  <div class="text-center">
        {{Form::submit('Message ' .$name, ['class'=>'btn btn-block btn-primary'])}}
        </div>

{{Form::close()}}
    @endsection
