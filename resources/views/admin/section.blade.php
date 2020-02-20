@extends('layouts.admin')


@section('pagetitle')
Sections - Admin
@endsection

@section('content')
<p class="maintext">SECTIONS
<hr>
</p>

<br>
<div class="card">
<div class="card-header">Add new section</div>
<div class="card-body">
        {{Form::open(['action'=>'SecController@store', 'method'=>'POST', 'class'=>'row'])}}
        <div class="col-md-6">
            {{Form::text('name', '',['placeholder'=>'Section Name', 'required'=>'required', 'minlength'=>3, 'class'=>'form-control' ])}}
            <br>
        </div>
        <div class="col-md-6">

            {{Form::button('<i class="fa fa-plus"></i> Add section', ['type'=>'submit', 'class'=>'btn btn-primary'])}}
        </div>
{{Form::close()}}

</div></div>
<br>
<div class="card">
    <div class="card-header">All sections</div>
        <div class="card-body">
            @if(count($secs) < 1)
                <h4>NO SECTION ADDED YET</h4>
                @else

                <table class="table">

                        <thead class="thead-light">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                                @foreach($secs as $sec)
                            <tr>

                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$sec->name}}</td>
                            <td>{{$sec->created_at->diffForHumans()}}</td>
                            <td>
                                    <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$sec->id}})" data-target="#DeleteModal" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                <a href="/admin/secedit/{{$sec->id}}" class='btn btn-xs btn-primary'><i class='fa fa-edit'></i></a>
                            </td>

                        </tr>
                        @endforeach
{{$secs->links()}}
                        </tbody>
                      </table>
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

var url = '{{ route("secdelete", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit()
        {
            $("#deleteForm").submit();
        }
     </script>
@endsection
