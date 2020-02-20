<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Forum;
use App\Thread;
use App\Section;
class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sec=Section::all();
return view('forum.index')->with('secs', $sec);
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
        $this->validate($request,[
            'name'=>'required|min:3|unique:forums',
            'note'=>'required|min:5',
            'secid'=>'required',
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
    $forum = new Forum;
    $forum->name=$request->input('name');
    $forum->description=$request->input('note');
    $forum->photo=$filenew;
    $forum->slug=forumslug($request->input('name'));
    $forum->secid=$request->input('secid');
    $forum->save();
    return redirect('/admin/forum')->with('success', 'New Forum Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
    //    $forum=Forum::findOrFail($id);
    $forum = Forum::where('slug', $slug)->firstOrFail();
    $id = $forum->id;
    $thread=Thread::where('forumid', $id)->whereHas('Post')->orderBy('created_at', 'DESC')->get();
        return view('forum.forum', compact('forum', 'thread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            $forum=Forum::findOrFail($id);
            $secs=Section::all();
            return view('admin.forumedit', compact('forum', 'secs'));

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
            'name'=>'required|min:3',
            'note'=>'required|min:5',
            'secid'=>'required',
            'image'=>'nullable|image|max:1999'
            ]);
            $id=$request->input('id');
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
    $forum2=Forum::find($id);

    $filenew=$forum2->photo;
}

$forum = Forum::find($id);
    $forum->name=$request->input('name');
    $forum->description=$request->input('note');
    $forum->photo=$filenew;
    $forum->secid=$request->input('secid');
    $forum->save();
    return redirect('/admin/forum')->with('success', 'Forum updated successfully!');

}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $forum = Forum::find($id);
        $forum->delete();
        return redirect('/admin/forum')->with('success', 'Removed successfully!');
    }
}
