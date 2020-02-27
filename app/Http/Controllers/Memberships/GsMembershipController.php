<?php

namespace App\Http\Controllers\Memberships;

use App\GsMembership;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Members;
// use App\BedMembership;

class GsMembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $bed = BedMembership::all();


        // $members = Members::orderBy('school','asc')->get();
        // $membership = GsMembership::all()->first();
        // return view('admin.membershipfee.gs.index')->with('members', $members)->with('membership', $membership);

        
        // $memed = MemberEducation::find(2);
        // $memedschool = $memed->members->school;
        // $memedstat = $memed->ed_level;
        // dd($memedschool,$memedstat);

        // $members = MemberEducation::all();
        
        $membership = GsMembership::all();
        return view('admin.membershipfee.gs.index')->with('membership', $membership);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gshsmembership  $gshsmembership
     * @return \Illuminate\Http\Response
     */
    public function show(GsMembership $gsmembership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gshsmembership  $gshsmembership
     * @return \Illuminate\Http\Response
     */
    public function edit(GsMembership $gsmembership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gshsmembership  $gshsmembership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GsMembership $gsmembership)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gshsmembership  $gshsmembership
     * @return \Illuminate\Http\Response
     */
    public function destroy(GsMembership $gsmembership)
    {
        //
    }
}
