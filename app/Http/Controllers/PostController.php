<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Thread;
use App\Notification;
use Mail;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
    $this->middleware('auth', ['except'=>'show']);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'message'=>'required|min:3',
            'user'=>'required',
            'threadid'=>'required'

        ]);
        $post=new Post;
        $post->user=$request->input('user');
        $post->threadid=$request->input('threadid');
        $post->message=$request->input('message');
     //fetch thread id and postid
        $threadid=$request->input('threadid');
        $thread = Thread::find($threadid);
        $post->type = "post";
        $post->save();
        $post2=Post::where('user', auth()->user()->name)->orderBy('id', 'DESC')->first();
        $pid=$post2->id;
//sendmail
Mail::to($thread->user->email, $thread->user->name)->send(new Thread($thread));
    //zoom redirect!
return redirect("/thread/" .$thread->slug ."#p" .$pid)->with('success', 'New comment added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
$post=Post::findOrFail($id);
$tid=$post->threadid;
if($post->user == auth()->user()->name || auth()->user()->level == 3)
{
    return view('forum.editpost')->with('post', $post);
}else
{
   return redirect('/thread/' .$post->thread->slug)->with('error', 'Authorized action!');
}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'message'=>'required|min:3',
            'cid'=>'required',
            'tid'=>'required'

        ]);
        $id=$request->input('cid');
        $tid=$request->input('tid');
        $post=Post::find($id);
        $post->message=$request->input('message');
     //fetch thread id and postid
        $post->save();

    //zoom redirect!
    return redirect("/thread/" .$post->thread->slug ."#p" .$id)->with('success', 'Comment updated successfully!');
    }

    function quote($id)
    {
        $post=Post::findOrFail($id);
        if ($post->thread->locked == 1)
        {
return redirect()->back()->with('error', 'Comments is disabled for this thread!');
        }
        return view('forum.quote')->with('post', $post);
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

        $post=new Post;
        $post->user=auth()->user()->name;
        $post->threadid=$tid;
        $post->type = "post";
        $post->message=$msgnew;
     //fetch thread id and postid
        $post->save();
        $post2=Post::where('user', auth()->user()->name)->orderBy('id', 'DESC')->first();
        $pid=$post2->id;

//add notification
$nthread = Thread::find($tid);
$npost = Post::find($qid);
if(auth()->user()->name != $npost->user)
{
$notify = new Notification;
$notify->user = $npost->user;
$notify->message =auth()->user()->name ." just quoted your post in " .$nthread->title;
$notify->save();
}


        //zoom redirect!
    return redirect("/thread/" .$nthread->slug ."#p" .$pid)->with('success', 'Your reply has been added successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $post = Post::findOrFail($id);
     $tid=$post->threadid;
     if(auth()->user()->level == 3)
     {
 $post->delete();
     return redirect('/thread/' .$post->thread->slug)->with('success', 'Post was removed successfully');
     }else
     {
        return redirect('/thread/' .$post->thread->slug)->with('error', 'Authorized action!');
     }

    }
}
