@extends('layouts.app')

@section('content')


<div class="card">
<div class="card-header">Change Photo</div>
    <div class="card-body">

<div class="alert alert-warning">Don't use any inappropriate picture for your account.</div>
        {{Form::open(['action'=>'UserController@storephoto', 'method'=>'POST', 'enctype'=>'multipart/form-data'])}}
        <div class="form-group text-center">
        <p>{{Form::label('image', 'Choose Photo (Max. 2mb) : ')}}</p>
        {{Form::file('image')}}

        </div>
        <div class="text-center">
        {{Form::submit('Change Photo', ['class'=>'btn btn-block btn-primary'])}}
        </div>
        {{Form::close()}}

    </div>
</div>



@endsection
