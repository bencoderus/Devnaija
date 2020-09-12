<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Forum;
use App\Thread;
use Illuminate\Http\Request;

class DbController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $forums = Forum::orderBy('id', 'DESC')->take(1)->get();
        $comments = Comment::orderBy('id', 'DESC')->take(1)->get();
        $threads = Thread::orderBy('created_at', 'DESC')->take(1)->get();
        $mythreads = Thread::where('author', auth()->user()->name)->orderBy('created_at', 'DESC')->paginate(5);

        return view('dashboard', compact('forums', 'threads', 'mythreads'));
    }
}
