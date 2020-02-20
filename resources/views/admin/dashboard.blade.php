@extends('layouts.admin')

@section('pagetitle')
Admin Dashboard - {{config('app.name')}}
@endsection
@section('content')

 <div class="row">
<div class="col-md-6 col-lg-8">
        <p class="lead font-weight-bold text-uppercase text-primary">
                ADMIN DASHBOARD
        </p>
</div>

<div class="dropdown user-dropdown col-md-6 col-lg-4 text-center text-md-right"><a class="btn btn-stripped dropdown-toggle" href="/user/{{auth()->user()->name}}" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

    <img src="/storage/usersphoto/{{strlen(mydp(auth()->user()->name)) > 0 ? mydp(auth()->user()->name) : "nophoto.jpg"}}" alt="profile photo" class="circle float-left profile-photo" width="50" height="auto">
    <div class="username mt-1">
    <h4 class="mb-1">{{auth()->user()->name}}</h4>
        <h6 class="text-muted">Admin</h6>
     </div>
    </a></div>
</div>
<hr>
<div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-folder"></i>
              </div>
              <div class="mr-5">Sections</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="/admin/section">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-info o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-comment"></i>
              </div>
              <div class="mr-5">Forums</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="/admin/forum">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-commenting"></i>
              </div>
              <div class="mr-5">Threads</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="/admin/thread">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-comments"></i>
              </div>
              <div class="mr-5">Posts</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="/admin/post">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        </div>
<!--end of cards-->
<br>

@if(count($threads) > 0)

<div class="card">
    <div class="card-header">
Newest Thread
    </div>
    <div class="card-body">
        @foreach($threads as $thread)
        <p><a href="/thread/{{$thread->slug}}" class="font-weight-bold">{{$thread->title}}</a> in <a href="/forum/{{$thread->forum->slug}}" class="font-weight-bold">{{$thread->forum->name}}</a> </p>
        <small>Added: {{$thread->created_at->diffForHumans()}}</small>
        <hr>
    @endforeach
    </div>
</div>


@endif

<br>

@if(count($forums) > 0)

<div class="card">
    <div class="card-header">
        Newest Forum
    </div>
    <div class="card-body">
        @foreach($forums as $forum)
        <p><a href="/forum/{{$forum->id}}" class="font-weight-bold">{{$forum->name}}</a> ({{$forum->thread->count()}}) </p>
        <small>Added: {{$forum->created_at->diffForHumans()}}</small>
        <hr>
    @endforeach
    </div>
</div>
@endif


@endsection
