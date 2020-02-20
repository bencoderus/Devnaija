@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item"><a href="/forum">Forum</a></li>
         <li class="breadcrumb-item"><a href="/forum/{{$thread->forum->id}}">{{$thread->forum->name}}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{$thread->title}}</li>
        </ol>
      </nav>
<p class="h3">{{$thread->title}}</p>
<p><i class="fa text-primary fa-eye"></i> {{$thread->views}} Views <i class="fa text-primary fa-comments-o"></i> {{$thread->post->count()}} Posts
</p>

<br>
{{--post starts here--}}

@if(count($posts) > 0)
@foreach($posts as $post)
@auth
@php
$likepost=App\Likepost::where('pid', $post->id)->where('user', auth()->user()->name)->get();
$photo=App\User::where('name', $post->user)->value('photo');
@endphp
@endauth
@if($loop->iteration == 1)
{{--THE AUTHORS POST--}}
<div class="card" id="p{{$post->id}}">
        <div class="card-header">

                @if(isset($photo))
                <img src="/storage/usersphoto/{{$photo}}" alt="avatar" class="rounded-circle" style="width: 5%">
                @else
                <img src="/images/avatar.png" alt="avatar" class="rounded-circle" style="width: 5%">
                @endif
        <a href="/user/{{$post->user}}">{{$post->user}}</a> posted {{$post->created_at->diffForHumans()}}<span class="pull-right"># {{$loop->iteration}}</span></div>
        <div class="card-body">
            @if($thread->photo == "nophoto.jpg")

            @else
                <p class="text-center"><img src="/storage/uploads/{{$thread->photo}}" style="width: 90%;" alt=""></p>
                @endif

            {!!ucfirst($post->message)!!}
<p><small class="text-danger">
@if(count($post->like) == 0)

@elseif(count($post->like) == 1)
{{$post->like->count()}} Like
@else
{{$post->like->count()}} Likes
@endif
</small>
</p>
@auth
        <div class="row">
                <div class="col-auto">
                        @if(count($likepost) == 0)
                        {{Form::open(['action'=>'ThreadController@like', 'method'=>'POST'])}}
                            {{Form::hidden('pid', $post->id,['id'=>'lpid'])}}
                            {{Form::hidden('tid', $thread->id,['id'=>'ltid'])}}
                            {{Form::button('<i class="fa fa-heart"></i> Like', ['class'=>'btn btn-sm btn-primary', 'type'=>'submit', 'id'=>'like'])}}
                            {{Form::close()}}
                        @else
                        {{Form::open(['action'=>'ThreadController@unlike', 'method'=>'POST'])}}
                            {{Form::hidden('pid', $post->id)}}
                            {{Form::hidden('tid', $thread->id)}}
                            {{Form::button('<i class="fa fa-heart active"></i> Unlike', ['class'=>'btn btn-sm btn-primary', 'type'=>'submit'])}}
                            {{Form::close()}}

                        @endif
                            </div>

            <div class="col-auto">
                <a href="/thread/quote/{{$post->id}}" class="btn btn-sm btn-primary"> <i class="fa fa-quote-left"></i> Quote</a>
                </div>
                @if(auth()->user()->level >= 3)
                <div class="col-auto">
                        @if($thread->locked ==0)
                        {{Form::open(['action'=>'ThreadController@lock', 'method'=>'POST'])}}
                        {{Form::hidden('id', $thread->id,['id'=>'lid'])}}
                        {{Form::button('<i class="fa fa-check-circle"></i> Lock', ['class'=>'btn btn-sm btn-primary', 'id'=>'lockthread'])}}
                        {{Form::close()}}
                        @else

                        {{Form::open(['action'=>'ThreadController@unlock', 'method'=>'POST'])}}
                        {{Form::hidden('id', $thread->id)}}
                        {{Form::button('<i class="fa fa-check-circle"></i> Unlock', ['class'=>'btn btn-sm btn-primary', 'type'=>'submit'])}}
                        {{Form::close()}}

                        @endif
                        </div>



                <div class="col-auto">
                <a href="/thread/edit/{{$thread->id}}" class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i> Edit</a>
                </div>
                <div class="col-auto">
                        <a href="javascript:;" data-toggle="modal" onclick="deleteData2({{$thread->id}})" data-target="#DeleteModal2" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>
                </div>
@elseif($thread->author == auth()->user()->name && !auth()->user()->level < 3)
<div class="col-auto">
        <a href="/thread/edit/{{$thread->id}}" class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i> Edit</a>
        </div>


                @endif
            </div>
            @endauth
        </div>

    </div>

        <br>
@else




{{--NOT THE AUTHORS POST--}}
<div class="card" id="p{{$post->id}}">
        <div class="card-header">

                @if(isset($photo))
                <img src="/storage/usersphoto/{{$photo}}" alt="avatar" class="rounded-circle" style="width: 5%">
                @else
                <img src="/images/avatar.png" alt="avatar" class="rounded-circle" style="width: 5%">
                @endif

            <a href="/user/{{$post->user}}">{{$post->user}}</a> replied {{$post->created_at->diffForHumans()}}<span class="pull-right"># {{$loop->iteration}}</span></div>
        <div class="card-body">

            {!!ucfirst($post->message)!!}
          <p><small class="text-danger">
                @if(count($post->like) == 0)

                @elseif(count($post->like) == 1)
                {{$post->like->count()}} Like
                @else
                {{$post->like->count()}} Likes
                @endif
            </small></p>
        @auth
            <div class="row">
                <div class="col-auto">
                        @if(count($likepost) == 0)
                        {{Form::open(['action'=>'ThreadController@like', 'method'=>'POST'])}}
                            {{Form::hidden('pid', $post->id)}}
                            {{Form::hidden('tid', $thread->id)}}
                            {{Form::button('<i class="fa fa-heart"></i> Like', ['class'=>'btn btn-sm btn-primary', 'type'=>'submit'])}}
                            {{Form::close()}}
                        @else
                        {{Form::open(['action'=>'ThreadController@unlike', 'method'=>'POST'])}}
                            {{Form::hidden('pid', $thread->id)}}
                            {{Form::hidden('tid', $thread->id)}}
                            {{Form::button('<i class="fa fa-heart active"></i> Unlike', ['class'=>'btn btn-sm btn-primary', 'type'=>'submit'])}}
                            {{Form::close()}}

                        @endif
                            </div>

                <div class="col-auto">
                <a href="/thread/quote/{{$post->id}}" class="btn btn-sm btn-primary"> <i class="fa fa-quote-left"></i> Quote</a>
                </div>
                @if(auth()->user()->level >= 3 || $post->user==auth()->user()->name)
                <div class="col-auto">
                <a href="/thread/editpost/{{$post->id}}" class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i> Edit</a>
                </div>
                <div class="col-auto">
                        <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$post->id}})" data-target="#DeleteModal" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>
                </div>
                @endif
            </div>
            @endauth
        </div>
        </div>
<br>

@endif


@endforeach

{{ $posts->links() }}
@endif

{{--posts end here--}}

@auth
<br>
<div class="p-3 mb-2 text-white bg-primary">Please ensure you have read the forum rules before replying to this thread</div>
@if($thread->locked==0)
{{Form::open(['action'=>'PostController@store', 'method'=>'POST'])}}
{{Form::hidden('user', auth()->user()->name)}}
{{Form::hidden('threadid', $thread->id)}}
<div class="form-group">
        {{Form::textarea('message','', ['placeholder'=>'Type your post', 'id'=>'article-ckeditor', 'rows'=>'5'])}}
</div>
<div class="form-group text-center">
    {{Form::button('Reply', ['class'=>'btn btn-block btn-primary', 'type'=>'submit'])}}
</div>
<br>

{{Form::close()}}
@else
<br><h3 class="text-center">COMMENTS DISABLED!</h3>
@endif
@endauth
@guest
<div class="card">
    <div class="card-body">
        <h6><a href="/login">Sign In</a> to participate in thread</h6>
    </div>
</div>

@endguest


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


<div id="DeleteModal2" class="modal fade text-danger" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" id="deleteForm2" method="post">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title text-dark">Delete Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>           <div class="modal-body">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                          <p class="text-dark">Are You Sure Want To Delete This Thread?</p>
                      </div>
                      <div class="modal-footer">
                          <center>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                              <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit2()">Yes, Delete</button>
                          </center>
                      </div>
                  </div>
              </form>
            </div>
           </div>
           <script type="text/javascript">
            function deleteData2(id)
            {
                var id = id;

    var url = '{{ route("tdelete", ":id") }}';
                url = url.replace(':id', id);
                $("#deleteForm2").attr('action', url);
            }

            function formSubmit2()
            {
                $("#deleteForm2").submit();
            }
$(document).ready(function(){
    $("#lockthread").on("click", function(){
        var lid = $("#lid").val();
        axios.post('/ajax/threadlock', {
            lid: lid
        }).then(function(response){
console.log("Done");
        }).catch(function(error){

        })
confirm("You have turned off commenting for this thread" +lid)

    })
})

         </script>
@endsection
