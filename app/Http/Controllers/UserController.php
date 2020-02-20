<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Thread;
use App\Post;
use App\Notification;

class UserController extends Controller
{

//Protect from guest
public function __construct()
    {
        $this->middleware('auth');
    }

    public function account()
    {
        return view('account.index');
    }

//notification
public function notify()
{
$not = Notification::where('user', auth()->user()->name)->orderBy('created_at', 'DESC')->get();
$seen = Notification::where('user', auth()->user()->name)->where('read', 0)->update(['read'=> 1]);
return view('account.notifications')->with('notify', $not);
}

//user profile
    public function profile($name)
    {
        $user=User::where('name', $name)->firstOrFail();
        $threads=Thread::where('author', $name)->take(5)->orderBy('id', 'DESC')->get();
        $posts=Post::where('user', $name)->take(5)->orderBy('id', 'DESC')->get();
        return view('profile', compact('user', 'threads', 'posts'));
    }
    public function mythread($name)
    {
        $user=User::where('name', $name)->firstOrFail();
        $thread=Thread::where('author', $name)->paginate(15);
        return view('account.thread', compact('thread', 'user'));
    }
//change photo
    public function myphoto()
    {
        return view('account.photo');
    }

    //store photo in db

public function storephoto(Request $request)
{
$this->validate($request,
 [
     'image'=>'image|required|max:1999'
 ]);
    $file=$request->file('image')->getClientOriginalName();
    $ext=$request->file('image')->getClientOriginalExtension();
    $filenew='user'.auth()->user()->id ."." .$ext;
    $path=$request->file('image')->storeAS('public/usersphoto', $filenew);
    $userid=auth()->user()->id;
    $user=User::findOrFail($userid);
    $user->photo=$filenew;
    $user->save();
return redirect('/dashboard')->with('success', 'Your new profile photo has been updated');
}

}
