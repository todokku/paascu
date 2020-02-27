<?php

namespace App\Http\Controllers\Memberships;

use App\BedMembership;
use Illuminate\Http\Request;
use App\BedMembership;

class BedMembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $membership = BedMembership::all();
        return view('admin.membershipfee.bed.index')->with('membership', $membership);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BedMembership  $bedMembership
     * @return \Illuminate\Http\Response
     */
    public function show(BedMembership $bedMembership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BedMembership  $bedMembership
     * @return \Illuminate\Http\Response
     */
    public function edit(BedMembership $bedMembership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BedMembership  $bedMembership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BedMembership $bedMembership)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BedMembership  $bedMembership
     * @return \Illuminate\Http\Response
     */
    public function destroy(BedMembership $bedMembership)
    {
        //
    }
}
