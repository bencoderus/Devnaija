<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\section;

class SecController extends Controller
{

 function __construct()
 {
$this->middleware('admin');
$this->middleware('auth');
 }
 //adding new section
 function create()
 {

 }
function store(Request $request)
{
    $this->validate($request,[
        'name'=>'required|unique:sections'
    ]);
$sec=new Section;
$sec->name=$request->input('name');
$sec->save();
return redirect('/admin/section')->with('success', 'New section successfully added!');
}


function update(Request $request)
{
    $this->validate($request,[
        'name'=>'required',
        'id'=>'required'
    ]);
    $id=$request->input('id');
    $sec=Section::find($id);
    $sec->name=$request->input('name');
    $sec->save();
    return redirect('/admin/section')->with('success', 'Section modified successfully!');
}


function index()
{
    $sec=Section::orderBy('created_at', 'DESC')->get();
    return view('admin.section')->with('secs', $sec);
}

function edit($id)
{
    $sec=Section::findOrFail($id);

    return view('admin.secedit')->with('sec', $sec);
}

public function destroy($id)
{
    //
    $sec=Section::find($id);
    $sec->delete();
    return redirect('/admin/section')->with('success', 'Section deleted successfully');
}
}


