@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">You have been banned</div>
    <div class="card-body">Hello {{auth()->user()->name}}, You have been banned from {{config('app.name')}} for violating the rules that guide the forum. Please contact an adminstrator if you have been banned wrongly!</div>
</div>


@endsection
