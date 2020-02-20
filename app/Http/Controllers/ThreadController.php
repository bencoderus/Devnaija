<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\forum;
use App\comment;
use App\thread;
use App\Likepost;
use App\Post;
use App\Notification;

class ThreadController extends Controller
{

public function __construct()
{
$this->middleware('auth', ['except'=>'show']);
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $forum=Forum::findOrFail($id);
        //returning forum details
        return view('forum.create')->with('forum', $forum);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|min:4|unique:threads',
            'body'=>'required|min:5',
            'image'=>'nullable|image|max:1999'
            ]);
            if($request->hasFile('image'))
{
$file=$request->file('image')->getClientOriginalName();
$ext=$request->file('image')->getClientOriginalExtension();
$filename=pathinfo($file, PATHINFO_FILENAME);
$filenew='image'.time().'.'.$ext;
$path=$request->file('image')->storeAs('public/uploads', $filenew);
}
else
{
    $filenew="nophoto.jpg";
}
$thread=new Thread;
    $thread->title=$request->input('title');

    $thread->body=$request->input('body');
    $thread->photo=$filenew;
    $thread->forumid=$request->input('forumid');
    $thread->author=$request->input('author');
    $thid = $thread->id;
    $thread->slug=getslug($request->input('title'));
    $thread->save();
//fetching id of the recently created thread
    $thread2=Thread::where('author', auth()->user()->name)->orderBy('id', 'DESC')->first();
    $tid=$thread2->id;
    $post = new Post;
    $post->user= auth()->user()->name;
    $post->message = $request->input('body');
    $post->threadid = $tid;
    $post->type = "thread";
    $post->save();
return redirect('/thread/' .$tid)->with('success', 'New Thread Added Successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
/*
    public function show($slug)
    {
//        $thread=Thread::findOrFail($id);
        $thread = Thread::where('slug', $slug)->firstOrFail();
        $thread->views+=1;

        //returning comments
        $posts=Post::where('threadid', $id)->orderBy('created_at', 'ASC')->paginate(10);
        $thread->save();
        return view('forum.showtopic', compact('thread','posts'));
    }
*/

    public function show($slug)
    {
        $thread = Thread::where('slug', $slug)->firstOrFail();
        $thread->views+=1;

        //returning comments
        $posts=Post::where('threadid', $thread->id)->orderBy('created_at', 'ASC')->paginate(10);
        $thread->save();
        return view('forum.showthread', compact('thread','posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    $thread=Thread::findOrFail($id);
//validating who can edit thread
if($thread->author == auth()->user()->name || auth()->user()->level == 3)
{
    $post=Post::where('threadid', $id)->first();
    return view('forum.edit', compact('thread', 'post'));
}else
{
   return redirect('/thread/' .$id)->with('error', 'Authorized action!');
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

        $this->validate($request,[
            'title'=>'required|min:4',
            'body'=>'required|min:5',
            'image'=>'nullable|image|max:1999'
            ]);
            $id=$request->input('threadid');
            $pid=$request->input('postid');
            $thread=Thread::find($id);
            if($request->hasFile('image'))
{
$file=$request->file('image')->getClientOriginalName();
$ext=$request->file('image')->getClientOriginalExtension();
$filename=pathinfo($file, PATHINFO_FILENAME);
$filenew='image'.time().'.'.$ext;
$path=$request->file('image')->storeAs('public/uploads', $filenew);
}
else
{
    $filenew=$thread->photo;
}
    $thread->title=$request->input('title');
    $thread->body=$request->input('body');

    $thread->slug=getslug($request->input('title'));
    $thread->photo=$filenew;
    $thread->save();

    $post=Post::find($pid);
    $post->message = $request->input('body');
    $post->save();

return redirect('/thread/' .$id)->with('success', 'Changes Updated Successfully!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if(auth()->user()->level > 1)
        {
            $post = Thread::findOrFail($id);
            $fid = $post->forumid;
            $post->delete();
            return redirect('/forum/' .$fid)->with('success', 'Thread was removed successfully');
        }else
        {
           return redirect('/thread/' .$id)->with('error', 'Authorized action!');
        }


        $post = Thread::findOrFail($id);
     $fid = $post->forumid;
     $post->delete();
     return redirect('/forum/' .$fid)->with('success', 'Thread was removed successfully');
    }

    public function lock(Request $request)
    {
        $id=$request->input('id');
        $thread=Thread::find($id);
        $thread->locked=1;
        $thread->save();
        return redirect('/thread/'.$thread->slug)->with('success', 'Comment has been disabled!');
    }
    public function unlock(Request $request)
    {
        $id=$request->input('id');
        $thread=Thread::find($id);
        $thread->locked=0;
        $thread->save();
        return redirect('/thread/'.$thread->slug)->with('success', 'Comment has been enabled!');
    }

//likes
public function like(Request $request)
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
    return redirect("/thread/" .$tid ."#p" .$id)->with('success', 'Like added!');
}

public function unlike(Request $request)
{
    $id=$request->input('pid');
    $tid=$request->input('tid');
    $like=Likepost::where('pid', $id)->where('user', auth()->user()->name)->firstOrFail();
    $like->delete();
    return redirect("/thread/" .$tid ."#p" .$id)->with('success', 'Thread Unlike!');
}

public function search()
{
    return view('forum.search');
}


public function find(Request $request)
{
$this->validate($request, [
    'search'=>'required|string|min:3|max:30'
]);
$search = $request->input('search');
//$thread = Thread::where('title', 'like', '%$search%')->get();
return redirect('/forum/search')->with('search', $search);
}


}
