<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ScheduleMembership;

class ScheduleMembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $smf = ScheduleMembership::all();
        return view('main.schedulemembership.index')->with('smf', $smf);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('main.schedulemembership.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $SM = new ScheduleMembership();
        $SM->gtrs = $request->input('gtrs');
        $SM->gtre = $request->input('gtre');
        $SM->amf = $request->input('amf');
        $SM->status = 'active';

        if($SM->save()){

        $request->session()->flash('success', 'Schedule Membership Fee has been Added');
        }else{
        $request->session()->flash('error', 'Error in Schedule Membership Fee Registration');
        }
        return redirect()->route('schedulemembership.index');
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
        $SM = ScheduleMembership::find($id);
        return view('main.schedulemembership.edit')->with('SM', $SM);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $SM = ScheduleMembership::find($request->input('id'));
        //add id of member here from dropdown!
        $SM->gtrs = $request->input('gtrs');
        $SM->gtre = $request->input('gtre');
        $SM->amf = $request->input('amf');
        $SM->status = $request->input('status');

        if($SM->save()){

        $request->session()->flash('success', 'Schedule Membership Fee has been Updated');
        }else{
        $request->session()->flash('error', 'Error in Schedule Membership Fee');
        }
        return redirect()->route('schedulemembership.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $SM = ScheduleMembership::find($id);
        if($SM->delete()){
        $request->session()->flash('error', 'Schedule Membership Fee has been deleted!');
        }
        return redirect()->route('schedulemembership.index');
    }
}
