<?php
$thready=App\Thread::orderBy('views', 'DESC')->take(20)->get();
?>

<p class="maintext">
TRENDING
</p><hr>
@if(count($thready) > 0)
@foreach($thready as $tthread)
<a href="/thread/{{$tthread->slug}}" class="text-dark font-weight-bold">{{$tthread->title}}</a>
<hr>
@endforeach
@endif
</p>

<br>
<p class="maintext">SEARCH</p><hr>
{{Form::open(['action'=>'ThreadController@find', 'method'=>'POST'])}}
<div class="input-group">
      <input type="text" name="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2">
      <div class="input-group-append">
        <button class="btn btn-primary" type="submit">
          <i class="fa fa-search"></i>
        </button>
      </div>
    </div>

{{Form::close()}}

<br><br>
<p class="maintext">BEST POSTS</p>
<hr><p>Why you need to have a Github repo for your works</p><hr>
<p>Freelancing might actually be the solution to unemployment in Nigeria</p><hr>
<p>Why you need to learn a framework in 2019</p><hr>
