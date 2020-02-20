@extends('layouts.app')

@section('content')

<p class="lead font-weight-bold text-uppercase text-primary">DASHBOARD</p>
<hr>


<div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-comment"></i>
              </div>
              <div class="mr-5">Forum</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="/forum">
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
                <i class="fa fa-fw fa-user"></i>
              </div>
              <div class="mr-5">Account</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="/account">
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
                <i class="fa fa-bell"></i>
              </div>
              <div class="mr-5">Notifications</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="/account/notifications">
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
                <i class="fa fa-envelope"></i>
              </div>
              <div class="mr-5">Messages</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="/message">
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

<div class="card">
    <div class="card-header bg-primary text-white">
    My Threads
    </div>
        <div class="card-body">

                @if(count($mythreads) > 0)
                @foreach($mythreads as $thread)
                    <p><a href="/thread/{{$thread->slug}}" class="font-weight-bold">{{$thread->title}}</a> in <a href="/forum/{{$thread->forum->slug}}" class="font-weight-bold">{{$thread->forum->name}}</a> </p>
<hr>
                @endforeach

                {{$mythreads->links()}}
                @endif
        </div>
    </div>
<br>

<div class="card">
    <div class="card-header bg-primary text-white">
    Newest Thread
    </div>
        <div class="card-body">

                @if(count($threads) > 0)
                @foreach($threads as $thread)
                    <p><a href="/thread/{{$thread->slug}}" class="font-weight-bold">{{$thread->title}}</a> in <a href="/forum/{{$thread->forum->id}}" class="font-weight-bold">{{$thread->forum->slug}}</a> </p><hr>
                @endforeach
                @endif
        </div>
    </div>



@endsection
