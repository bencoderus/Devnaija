@extends('layouts.admin')

@section('pagetitle')
Users - Admin
@endsection

@section('content')
<p class="maintext">
    ALL USERS
</p>
<hr>

<div class="card">
    <div class="card-header">Users</div>
        <div class="card-body">
            @if(count($users) < 1)
                <h4>NO USER ADDED YET</h4>
                @else

                <table class="table">

                        <thead class="thead-light">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Rank</th>
                            <th scope="col">Joined</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                                @foreach($users as $user)
                            <tr>

                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{checklevel($user->level)}}</td>
                            <td>{{$user->created_at->diffForHumans()}}</td>
                            <td>
                      @if($user->ban==0)
                                <button class="btn btn-sm btn-warning" onclick="banuser({{$user->id}}, '{{$user->name}}')"><i class="fa fa-user"></i> Ban</button>
                                @else
                                <button class="btn btn-sm btn-warning" onclick="unbanuser({{$user->id}}, '{{$user->name}}')"><i class="fa fa-user"></i> Unban</button>
                                @endif
                                <a href="/user/{{$user->name}}" class='btn btn-sm btn-info'><i class='fa fa-user'></i> Bio</a>
                            </td>

                        </tr>
                        @endforeach
{{$users->links()}}
                        </tbody>
                      </table>
                      @endif
                    </div>
</div>


<script>
    function banuser(uid, uname)
    {
var check = confirm("Are you sure you want to ban " +uname +"?");
   if(check ==true)
   {
axios.post('/ajax/banuser', {
    uid: uid,
    uname: uname
}).then(function(response){
    alert("User banned successfully!");
    location.reload();
}).catch(function(error){
    alert("Unknown error occured contact benart");
});
   }

    }

    function unbanuser(uid, uname)
    {
var check = confirm("Are you sure you want to unban " +uname +"?");
   if(check ==true)
   {
axios.post('/ajax/unbanuser', {
    uid: uid,
    uname: uname
}).then(function(response){
    alert("User unbanned successfully!");
    location.reload();
}).catch(function(error){
    alert("Unknown error occured contact benart");
});
   }

    }

</script>

@endsection
