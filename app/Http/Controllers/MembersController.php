<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Member;
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
        $members = Member::all();
        // return view('admin.users.index')->with('users', $users);
        return view('admin.members.index')->with('members', $members);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.members.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $member = new Member();
        $member->institution = $request->input('institution');
        $member->address = $request->input('address');
        $member->program = $request->input('program');
        $member->level = $request->input('level');
        $member->valid = $request->input('valid');

        if($member->save()){

        $request->session()->flash('success', 'Member has been Added');
        }else{
        $request->session()->flash('error', 'Error in Member Registration');
        }
        return redirect()->route('admin.members.index');

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
        // $members = Member::all();

        // return view('admin.members.edit')->with('members',$members);
        // return view('admin.members.edit')->with('members',$members);
        //Find the employee
        $member = Member::find($id);
        return view('admin.members.edit')->with('member',$member);

        // $members = Member::all();

        // return view('admin.members.edit')->with($member);
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


        // $member->institution = $request->institution;
        // $member->address = $request->address;
        // $member->program = $request->program;
        // $member->level = $request->level;
        // $member->valid = $request->valid;

        $member = Member::find($request->input('id'));
        $member->institution = $request->input('institution');
        $member->address = $request->input('address');
        $member->program = $request->input('program');
        $member->level = $request->input('level');
        $member->valid = $request->input('valid');

        if($member->save()){

        $request->session()->flash('success', 'Member has been Updated');
        }else{
        $request->session()->flash('error', 'Error in Member Update');
        }
        return redirect()->route('admin.members.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::find($id);
        $member->delete();
        return redirect()->route('admin.members.index');
    }
}
