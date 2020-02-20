@extends('layouts.admin')

@section('pagetitle')
Users - Admin
@endsection

@section('content')
<p  class="maintext">
MANAGE FORUMS
</p><hr>

<br>
<div class="card">
<div class="card-header">New forum</div>
<div class="card-body">
        {{Form::open(['action'=>'ForumController@store', 'method'=>'POST', 'class'=>'row'])}}
        <div class="col-md-6">
            {{Form::text('name', '',['placeholder'=>'Forum Name', 'required'=>'required', 'minlength'=>3, 'class'=>'form-control' ])}}
<br>        </div>
            <div class="col-md-6">
           <select name="secid" class="form-control">
            <option value="">Select Section</option>
            @foreach($secs as $sec)
           <option value="{{$sec->id}}">{{$sec->name}}</option>
            @endforeach
        </select>

            </div>
            <br><br>
            <div class="col-md-12 form-group">
            {{Form::textarea('note', '', ['class'=>'form-control', 'rows'=>'4', 'placeholder'=>'About Forum'])}}
            </div>
            <br>
            <div class="col-md-12 forum-group">
              {{Form::label('Forum Image: ')}}
                {{Form::file('image')}}
            </div>
            <br><br>
        <div class="col-md-12 forum-group">

            {{Form::button('<i class="fa fa-plus"></i> Add forum', ['type'=>'submit', 'class'=>'btn btn-primary'])}}
            <br>
        </div>
{{Form::close()}}

</div></div>
<br>


<div class="card">
    <div class="card-header">All forum</div>
        <div class="card-body">
            @if(count($forums) < 1)
                <h4>NO FORUM ADDED YET</h4>
                @else

                <table class="table">

                        <thead class="thead-light">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Section</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                                @foreach($forums as $forum)
                            <tr>

                            <th scope="row">{{$forum->id}}</th>
                            <td>{{$forum->name}}</td>
                            <td>{{$forum->section->name}}</td>
                            <td>{{$forum->created_at->diffForHumans()}}</td>
                            <td>
                                <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$forum->id}})" data-target="#DeleteModal" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                <a href="/admin/forumedit/{{$forum->id}}" class='btn btn-xs btn-primary'><i class='fa fa-edit'></i></a>

                            </td>

                        </tr>
                        @endforeach

                        </tbody>
                      </table>

                      {{$forums->links()}}
                      @endif

                    </div>
</div>
<br><br>

<div id="DeleteModal" class="modal fade text-danger" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="" id="deleteForm" method="post">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-dark">Delete Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>           <div class="modal-body">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <p class="text-dark">Are You Sure Want To Delete ?</p>
                  </div>
                  <div class="modal-footer">
                      <center>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                          <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Yes, Delete</button>
                      </center>
                  </div>
              </div>
          </form>
        </div>
       </div>
       <script type="text/javascript">
        function deleteData(id)
        {
            var id = id;

var url = '{{ route("forumdelete", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit()
        {
            $("#deleteForm").submit();
        }
     </script>
@endsection
