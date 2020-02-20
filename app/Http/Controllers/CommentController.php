<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\comment;
class CommentController extends Controller
{
    //protect comments
    function __construct()
    {
        $this->middleware('auth');
    }
    function store(Request $request)
    {
        $this->validate($request, [
            'message'=>'required|min:3',
            'user'=>'required',
            'threadid'=>'required'
        ]);
        $comment=new Comment;
        $comment->user=$request->input('user');
        $comment->threadid=$request->input('threadid');
        $comment->message=$request->input('message');
     //fetch thread id and postid
        $threadid=$request->input('threadid');
        $comment->save();
        $post=Comment::where('user', auth()->user()->name)->orderBy('id', 'DESC')->first();
    $pid=$post->id;

    //zoom redirect!
return redirect("/thread/" .$threadid ."#p" .$pid)->with('success', 'New comment added!');
    }

function edit($id)
{
$comment=Comment::findOrFail($id);
return view('forum.editcomment')->with('comment', $comment);
}

function update(Request $request)
{
    $this->validate($request, [
        'message'=>'required|min:3',
        'cid'=>'required',
        'tid'=>'required'

    ]);
    $id=$request->input('cid');
    $tid=$request->input('tid');
    $comment=Comment::find($id);
    $comment->message=$request->input('message');
 //fetch thread id and postid
    $comment->save();

//zoom redirect!
return redirect("/thread/" .$tid ."#p" .$id)->with('success', 'Comment updated successfully!');
}


function quote($id)
{
    $comment=Comment::findOrFail($id);
    return view('forum.quote')->with('comment', $comment);
}

function quotereply(Request $request)
{
    $this->validate($request, [
        'message'=>'required|min:3',
        'qid'=>'required',
        'qmessage'=>'required',
        'quser'=>'required',
        'tid'=>'required'

    ]);
    $tid=$request->input('tid');
    $qid=$request->input('qid');
    $qmessage=$request->input('qmessage');
    //removing quotes if they existed in phrase
    $newmsg = preg_replace("(\<blockquote\>(.+?)\<\/blockquote\>)is","",$qmessage);
    $quser=$request->input('quser');
    $msg=$request->input('message');
    $msgnew="<blockquote><p><b>" .$quser ."</b> said: </p>" .$newmsg ."</blockquote>" .$msg;
    $comment=new Comment;
    $comment->user=auth()->user()->name;
    $comment->threadid=$tid;
    $comment->message=$msgnew;
 //fetch thread id and postid
    $comment->save();
    $post=Comment::where('user', auth()->user()->name)->orderBy('id', 'DESC')->first();
    $pid=$post->id;
    //zoom redirect!
return redirect("/thread/" .$tid ."#p" .$pid)->with('success', 'Your reply has been added successfully');
}

function destroy(Request $request)
{
$id=$request->input('id');
$tid=$request->input('tid');
$comment=Comment::find($id);
$comment->delete();
return redirect("/thread/" .$tid)->with('success', 'Comment removed successfully!');
}
}
