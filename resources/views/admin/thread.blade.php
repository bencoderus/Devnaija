@extends('layouts.admin')


@section('pagetitle')
Threads - Admin
@endsection

@section('content')
<p class="lead text-primary font-weight-bold">THREADS
<hr>
</p>

<br>
<div class="card">
<div class="card-header">All threads</div>
<div class="card-body">
    {{$threads->links()}}
@if(count($threads) < 1)
<h4>NO thread ADDED YET</h4>
@else

<table class="table">

<thead class="table-dark">
<tr>
<th scope="col">#</th>
<th scope="col">Name</th>
<th scope="col">Category</th>
<th scope="col">Date</th>
<th scope="col">Action</th>
</tr>
</thead>
<tbody>
@foreach($threads as $thread)
<tr>
<td>{{$loop->iteration}}</td>
<td><a href="/thread/{{$thread->slug}}">{{$thread->title}}</a></td>
<td>{{$thread->forum->name}}</td>
<td>{{$thread->created_at->diffForHumans()}}</td>
<td>
<a href="javascript:;" data-toggle="modal" onclick="deleteData({{$thread->id}})" data-target="#DeleteModal" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </a>
<a href="/thread/edit/{{$thread->id}}" class='btn btn-sm btn-primary'><i class='fa fa-edit'></i></a>
</td>

</tr>
@endforeach

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
<p class="text-dark">Are You Sure Want To Delete This Post?</p>
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

var url = '{{ route("postdelete", ":id") }}';
url = url.replace(':id', id);
$("#deleteForm").attr('action', url);
}

function formSubmit()
{
$("#deleteForm").submit();
}
</script>



@endsection
