<?php
$thready=App\Thread::orderBy('views', 'DESC')->take(20)->get();

?>

<p class="maintext">
TRENDING
</p>
@if(count($thready) > 0)
@foreach($thready as $thread)
{{$thread->title}}
<hr>
@endforeach
@endif
</p>
