<?php

namespace App\Http\Controllers\Memberships;

use App\HsMembership;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HsMembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $membership = HsMembership::all();
        return view('admin.membershipfee.hs.index')->with('membership', $membership);
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
     * @param  \App\HsMembership  $hsMembership
     * @return \Illuminate\Http\Response
     */
    public function show(HsMembership $hsMembership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HsMembership  $hsMembership
     * @return \Illuminate\Http\Response
     */
    public function edit(HsMembership $hsMembership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HsMembership  $hsMembership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HsMembership $hsMembership)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HsMembership  $hsMembership
     * @return \Illuminate\Http\Response
     */
    public function destroy(HsMembership $hsMembership)
    {
        //
    }
}
