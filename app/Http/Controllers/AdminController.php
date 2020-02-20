<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\section;
use App\forum;
use App\Thread;
use App\Post;
use App\User;
use App\Message;

class AdminController extends Controller
{
function __construct()
{
$this->middleware('admin');
$this->middleware('auth');
}    //

function dashboard()
{
    $secs=Section::orderBy('id', 'DESC')->take(1)->get();
    $forums=Forum::orderBy('id', 'DESC')->take(1)->get();
    $comments=Post::orderBy('id', 'DESC')->take(1)->get();
    $threads=Thread::orderBy('created_at', 'DESC')->take(1)->get();
    return view('admin.dashboard', compact('secs', 'forums', 'threads', 'comments'));
}

function forum()
{
    $secs=Section::all();
    $forums=Forum::paginate(10);
    return view('admin.forum', compact('secs', 'forums'));
}

function section()
{
    $secs=Section::paginate(10);
    return view('admin.section', compact('secs'));
}
function thread()
{
    $thread=Thread::orderBy('created_at', 'DESC')->paginate(25);

    return view('admin.thread')->with('threads', $thread);
}


function comment()
{
    $com=Post::orderBy('created_at', 'DESC')->paginate(25);
    return view('admin.post')->with('comments', $com);
}

public function users()
{
    $user=User::paginate(20);
    return view('admin.user')->with('users', $user);
}

//SEND BC
public function bc(){
    return view('admin.sendbc');
}
public function sendbc(Request $request){
$text = $request->input('message');
$sender = "Admin";
$users = User::all();
foreach($users as $user){
$msg = new Message;
$msg->receiver = $user->name;
$msg->message = $text;
$msg->sender= $sender;
$msg->save();
}

return redirect('/admin')->with('success', 'Messages has been sent!');
}
}
