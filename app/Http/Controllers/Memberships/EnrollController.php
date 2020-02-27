<?php

namespace App\Http\Controllers\Memberships;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Members;
use App\AccreditedCollegeProgram;
use App\AccreditedGraduateProgram;
use App\GsMembership;
use App\HsMembership;
class EnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $acp = AccreditedCollegeProgram::all();
        $agp = AccreditedGraduateProgram::all();
        $members = Members::orderBy('school','asc')->get();
        return view('admin.membershipfee.enroll.index')->with('members', $members)->with('acp', $acp)->with('agp', $agp);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function storegs(Request $request){

        $gs = new GsMembership();
        $gs->te = $request->input('gste');
        $gs->atf = $request->input('gsatf');
        $gs->member_id = $request->input('gsname');
        $gs->gtr = 404;
 
        if($gs->save()){

        $request->session()->flash('success', 'Grade School Membership has been Added');
        }else{
        $request->session()->flash('error', 'Error in Grade School Membership Registration');
        }
        return redirect()->route('enrollmembership.index');
  
    }

        public function storehs(Request $request){

        $hs = new HsMembership();
        $hs->te = $request->input('hste');
        $hs->atf = $request->input('hsatf');
        $hs->member_id = $request->input('hsname');
        $hs->gtr = 404;
 
        if($hs->save()){

        $request->session()->flash('success', 'High School Membership has been Added');
        }else{
        $request->session()->flash('error', 'Error in High School Membership Registration');
        }
        return redirect()->route('enrollmembership.index');
  
    }
}
