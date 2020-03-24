<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Members;
use App\Programs;

class ProgramsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Members::orderBy('school','asc')->get();
        // $programs = Programs::all();
        return view('admin.programs.index')->with('members', $members);
        // return view('admin.programs.index')->with('programs', $programs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {$members = Members::orderBy('school','asc')->get();

        return view('admin.programs.create')->with('members', $members);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $program = new Programs();
        //add id of member here from dropdown!
        $program->member_id = $request->input('school');
        $program->program = $request->input('program');
        $program->level = $request->input('level');
        $program->valid = $request->input('valid');
        $program->status = 'active';
        $program->ed_level = $request->input('ed_level');

        if($program->save()){

        $request->session()->flash('success', 'Program has been Added');
        }else{
        $request->session()->flash('error', 'Error in Program Registration');
        }
        return redirect()->route('admin.programs.index');

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
        $program = Programs::find($id);
        $members = Members::orderBy('school','asc')->get();
        return view('admin.programs.edit')->with('program', $program)->with('members', $members);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {//
        $program = Programs::find($request->input('id'));
        //add id of member here from dropdown!
        $program->member_id = $request->input('school');
        $program->program = $request->input('program');
        $program->level = $request->input('level');
        $program->valid = $request->input('valid');
        $program->status = $request->input('status');
        $program->ed_level = $request->input('ed_level');

        if($program->save()){

        $request->session()->flash('success', 'Program has been Updated');
        }else{
        $request->session()->flash('error', 'Error in Program Update');
        }
        return redirect()->route('admin.programs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $program = Programs::find($id);
        if($program->delete()){
        $request->session()->flash('error', 'Program has been deleted!');
        }
        return redirect()->route('admin.programs.index');
    }
}
