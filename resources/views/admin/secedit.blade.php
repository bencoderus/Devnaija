@extends('layouts.admin')

@section('pagetitle')
Edit Section - Admin
@endsection

@section('content')
<p class="maintext">EDIT SECTION</p>


<div class="card">
    <div class="card-header">Add new section</div>
    <div class="card-body">
            {{Form::open(['action'=>'SecController@update', 'method'=>'POST', 'class'=>'row'])}}
            <div class="col-md-6">
                {{Form::text('name', $sec->name,['placeholder'=>'Section Name', 'required'=>'required', 'minlength'=>3, 'class'=>'form-control' ])}}
                <br>
            </div>
            <div class="col-md-6">
                {{Form::hidden('id', $sec->id)}}
                {{Form::button('<i class="fa fa-edit"></i> Update Changes', ['type'=>'submit', 'class'=>'btn btn-primary'])}}
            </div>
    {{Form::close()}}

    </div></div>
    <br>

@endsection
