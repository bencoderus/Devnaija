@extends('layouts.admin')


@section('pagetitle')
Posts - Admin
@endsection

@section('content')
<p class="maintext">POSTS
<hr>
</p>

<br>
<div class="card">
<div class="card-header">All comment</div>
<div class="card-body">
@if(count($comments) < 1)
<h4>NO COMMENT ADDED YET</h4>
@else
{{$comments->links()}}
<table class="table">

<thead>
<tr>
<th scope="col">#</th>
<th scope="col">Message</th>
<th scope="col">Thread</th>
<th scope="col">User</th>
<th scope="col">Added</th>
<th scope="col">Action</th>
</tr>
</thead>
<tbody>
@foreach($comments as $comment)
<tr>

<th scope="row">{{$loop->iteration}}</th>
<td><a href="/thread/{{$comment->thread->slug}}#p{{$comment->id}}">{!!$comment->message!!}</a></td>
<td>{!!$comment->thread->title!!}</td>
<td>{!!$comment->user!!}</td>

<td>{{$comment->created_at->diffForHumans()}}</td>
<td>
<a href="/thread/editcomment/{{$comment->id}}" class='btn btn-sm btn-primary'><i class='fa fa-edit'></i></a>
</td>

</tr>
@endforeach

</tbody>
</table>

{{$comments->links()}}

@endif

</div>
</div>



<br><br>

@endsection
