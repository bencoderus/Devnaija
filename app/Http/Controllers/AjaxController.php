<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Post;
use App\User;
use App\likepost;
use App\Notification;

class AjaxController extends Controller
{
    //

    public function threadlock(Request $request)
    {
        $id=$request->input('lid');
        $thread=Thread::find($id);
        $thread->locked=1;
        $thread->save();
        return "sucesss";
    }


    public function likepost(Request $request)
{
    $id=$request->input('pid');
    $tid=$request->input('tid');
    $like= new Likepost;
    $like->user=auth()->user()->name;
    $like->pid=$id;
    $like->save();

    //add notification
    $thread = Thread::find($tid);
    $post = Post::find($id);
    if(auth()->user()->name != $post->user)
    {
    $notify = new Notification;
    $notify->user = $post->user;
    $notify->message =auth()->user()->name ." just liked your post in " .$thread->title;
    $notify->save();
    }
    return "Like added";
}



public function unlikepost(Request $request)
{
    $id=$request->input('pid');
    $tid=$request->input('tid');
    $like=Likepost::where('pid', $id)->where('user', auth()->user()->name)->firstOrFail();
    $like->delete();
    return "Unliked";
}


public function banuser(Request $request)
{
    $id=$request->input('uid');
    $uname=$request->input('uname');
    $user=User::findOrFail($id);
    $user->ban=1;
    $user->save();
    return "Done";

}

public function unbanuser(Request $request)
{
    $id=$request->input('uid');
    $uname=$request->input('uname');
    $user=User::findOrFail($id);
    $user->ban=0;
    $user->save();
    return "Done";

}
}
