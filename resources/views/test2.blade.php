@extends('layouts.app')

@php
$beno = "HEllo woeld";

$likepost=App\Likepost::where('pid', 1)->where('user', auth()->user()->name)->count();
$likes=App\Likepost::where('pid', 1)->count();
@endphp



@section('content')
<p class="maintext">ABOUT</p>

<a href="#" onclick="like(5,7)">hhdhdh</a>

<script>
var likecheck = {{$likepost}};
if(likecheck == 0)
{
$(document).ready(function(){
$("#like").show();
$("#unlike").hide();
})
}
else
{
$(document).ready(function(){
$("#like").hide();
$("#unlike").show();
})
}

function like(pid, tid)
{
alert("post id " +pid);
}
</script>


{{--
{{Form::open(['action'=>'PagesController@testup', 'method'=>'POST', 'enctype'=>'multipart/form-data'])}}
{{Form::text('name', '', ['class'=>'form-control mb-2', 'id'=>'name', 'required'])}}
{{Form::submit('Send', ['class'=>'btn btn-primary', 'id'=>'send'])}}
{{Form::close()}}
--}}

    </script>

@endsection
