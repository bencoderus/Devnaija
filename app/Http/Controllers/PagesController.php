<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\section;
use App\forum;
use App\Thread;
use App\Comment;
use App\User;
use App\Likepost;

class PagesController extends Controller
{
    //Check if user is logged in then redirect to dashboard
function index()
{
    if(auth()->check())
    {
        $date = date('Y-m-d H:i:s', time());
        $user = User::find(auth()->user()->id);
        $user->last_seen = $date;
        $user->save();
return redirect('/dashboard');
    }
    else
    {
        $thread=Thread::orderBy('views', 'DESC')->take(20)->get();
        return view('index')->with('threads', $thread);
    }

}

function account()
{
    return view('account.index');
}


function about()
{
    return view('about');
}


function contact()
{
    return view('contact');
}


function trending()
{
    $thread=Thread::orderBy('views', 'DESC')->take(20)->get();
    return view('trending')->with('threads', $thread);
}
function test2()
{
return view("test2");
}

function testup(Request $request)
{
if($request->hasFile('image'))
{
 $file = $request->file('image')->getClientOriginalName();
    return $request->file('image')->getClientOriginalName();
}
else
{
    return "it has no file";
}
}

function test4($id)
{
$count=Likepost::where('pid', $id)->count();
return $count;
}
function test3(Request $request)
{
$name=$request->input('name');
$user= User::where('name', $name)->count();
if($user==1 )
{
return 'error';
}
else
{
    return 'success';
}
}
function test()
{
    $users=User::whereHas('Thread')->withCount('Thread')->orderBy('Thread_count', 'DESC')->take(5)->get();
    $threads=Thread::whereHas('post')->withCount('post')->orderBy('post_count', 'DESC')->get();
    return view('test', compact('users', 'threads'));
}

function banned()
{
return view("banned");
}
}
