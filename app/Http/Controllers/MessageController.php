<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;

class MessageController extends Controller
{
#protect messages from guests
    public function __construct()
    {
$this->middleware('auth');

    }

#message dashboard
public function index()
{
    return view('message.index');
}

    #send message
    public function send($name=null)
    {
        return view('message.send', compact('name'));
    }


#Send message
    public function store(Request $request)
    {
     $this->validate($request, [
         'user' => 'required|min:2',
         'message' => 'required',
         'sender' => 'required'
     ]);

     $user=$request->input('user');
     $receiver=ucwords(str_replace("@", "", $user));
     //db receiver
     $receiver2=str_replace("@", "", $user);
     $sender =ucwords($request->input('sender'));
     if($sender == $receiver)
     {
        return redirect('/message')->with('error', 'Oops! You cant message yourself');
     }
else
{

     $msg= new Message;
     $msg->receiver = $receiver2;
     $msg->sender = $request->input('sender');
    $msg->message = $request->input('message');
    $msg->save();

       return redirect('/message/view/' .$receiver ."#m" .$msg->id);
}
    }


    #unread
    public function unread(){
    $msgs = Message::where('receiver', auth()->user()->name)->where('read', 0)->groupBy('sender')->get();
    return view('message.unread', compact('msgs'));
    }

    #inbox
    public function inbox(){
        $msgs = Message::where('receiver', auth()->user()->name)->groupBy('sender')->get();
        return view('message.inbox', compact('msgs'));
        }

#sent messages
public function sent()
{
    $msgs = Message::where('sender', auth()->user()->name)->orderBy('id', 'DESC')->get();
    return view('message.sent', compact('msgs'));
}

#View Messages
    public function view($name){
        $user=auth()->user()->name;
        //Updating read status for new mail
        Message::where('receiver', $user)->where('sender', $name)->where('read', 0)->update(['read'=>1]);

        $msgs = Message::whereIn('receiver', [$name, $user])->whereIn('sender', [$name, $user])->orderBy('created_at', 'ASC')->take(20)->get();

        return view('message.view', compact('msgs', 'name'));
        }
}
