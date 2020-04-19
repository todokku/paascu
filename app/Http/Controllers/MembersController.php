<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Members;
use App\Programs;
use Illuminate\Http\Request;
use Gate;
use DB;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Members::orderBy('school','asc')->get();
        $programs = Programs::all();
        return view('main.members.index')->with('members', $members)->with('programs', $programs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('main.members.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $member = new Members();
        $member->school = $request->input('school');
        $member->address = $request->input('address');
        $member->status = 'active';
        $member->image = $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $imageName);
            if($member->save()){
            $request->session()->flash('success', 'Member has been Added');
            }else{
            $request->session()->flash('error', 'Error in Member Registration');
            }
        return redirect()->route('members.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = Members::find($id);
        return view('main.members.edit')->with('member',$member);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $member)
    {
        $member = Members::find($request->input('id'));
        $member->school = $request->input('school');
        $member->address = $request->input('address');
        $member->status = $request->input('status');
            if ($request->hasFile('image')) {
            $member->image = $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images'), $imageName);
            }
            if($member->save()){
            $request->session()->flash('success', 'Member has been Updated');
            }else{
            $request->session()->flash('error', 'Error in Member Update');
            }
        return redirect()->route('members.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $member = Members::find($id);
        $path = public_path()."/images/".$member->image;
            if(file_exists($path) && strcmp($member->image, "default.png") !== 0 ){
        @unlink($path);
    }
        if($member->delete()){
        $request->session()->flash('error', 'Member has been deleted!');
        }
        return redirect()->route('members.index');
    }
}
