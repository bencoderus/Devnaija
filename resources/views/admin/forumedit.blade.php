@extends('layouts.admin')


@section('pagetitle')
Edit Forum - Admin
@endsection

@section('content')
<p class="maintext"> EDIT FORUM
</p><hr>

<br>
<div class="card">
<div class="card-header">Edit forum</div>
<div class="card-body">
        {{Form::open(['action'=>'ForumController@update', 'method'=>'POST', 'class'=>'row'])}}
        <div class="col-md-6">
            {{Form::text('name', $forum->name,['placeholder'=>'Forum Name', 'required'=>'required', 'minlength'=>3, 'class'=>'form-control' ])}}
<br>        </div>
            <div class="col-md-6">
           <select name="secid" class="form-control">
            <option value="">Select Section</option>
            @foreach($secs as $sec)
           <option value="{{$sec->id}}" <?php if($sec->id == $forum->secid) echo "selected"; ?>>{{$sec->name}}</option>
            @endforeach
        </select>

            </div>
            <br><br>
            <div class="col-md-12 form-group">
            {{Form::textarea('note', $forum->description, ['class'=>'form-control', 'rows'=>'4', 'placeholder'=>'About Forum'])}}
            </div>
            <br>
            <div class="col-md-12 forum-group">
              {{Form::label('Forum Image: ')}}
                {{Form::file('image')}}
            </div>
            <br><br>
        <div class="col-md-12 forum-group">
            {{Form::hidden('id', $forum->id)}}
            {{Form::button('<i class="fa fa-plus"></i> Update forum', ['type'=>'submit', 'class'=>'btn btn-primary'])}}
            <br>
        </div>
{{Form::close()}}

</div></div>
<br>

@endsection
