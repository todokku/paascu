<?php

namespace App\Http\Controllers\Memberships;

use App\BedMembership;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Members;
use App\MembershipFormula;
// use App\BedMembership;
use DB;
use App\ScheduleMembership;

use App\Membership;
use App\Variable;
use App\Compute;
use App\Formula;

class BedMembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Members::select('id','school')->whereHas('programs', function ($query) {
        $query->whereIn('program', ['Basic Education']);
        })
        ->whereHas('membership', function ($query) {
        $query->whereIn('formula_id', ['Basic Education']);
        })
        ->get();

        $membership = Membership::all();
        $variable = Variable::all();
        $membershipids = Membership::select('variable_id')->groupBy('variable_id')->where('formula_id', 'Basic Education')->with('variables')->get();
        $compute = Compute::all();

        // dd($membershipids);
        return view('admin.membershipfee.bed.index')->with('members',$members)->with('membership',$membership)->with('membershipids',$membershipids)->with('compute', $compute);
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
    public function edit($id)
    {
        $memid = $id;
        $school = Members::find($id);
        $membership = Membership::whereIn('member_id', [$id])->get();

        $compute = Compute::where('member_id', $id)->first();

        // dd($school);
        return view('admin.membershipfee.bed.edit')->with('membership', $membership)->with('compute',$compute)->with('school',$school)->with('memid',$memid);
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

//updating contents ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        $membership = Membership::whereIn('member_id', [$request->input('id')])->get();
        foreach($membership as $pihsrebmem){
        $bedupdate = Membership::find($pihsrebmem->id);
        $bedupdate->content = $request->input($pihsrebmem->id);
        $bedupdate->save();
        }

        //updating calculated values~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        $activestat = $request->input('status');
        $cformula = Formula::where('formula_id','Basic Education')->first();
        $cmembership = Membership::whereIn('member_id', [$request->input('id')])->get();

        $formulareplaced = $cformula->formula;
        $amfs;

        foreach ($cmembership as $pihsrebmem){
        $msfv = Variable::find($pihsrebmem->variable_id);
        $formulareplaced =   str_replace($msfv->code,$request->input($pihsrebmem->id),$formulareplaced);
        }   
        //time to compute the skyline gtr 
        $computedgtr = eval("return $formulareplaced;");
        //finding AMF via schedule start and end values ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        $scheduled = ScheduleMembership::all();
        foreach ($scheduled as $deludehcs){
        if($deludehcs->gtrs <= $computedgtr && $deludehcs->gtre >= $computedgtr){
            $amfs = $deludehcs->amf;
        }
        }
        // saving to compute~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        $cCompute = Compute::where('member_id', $request->input('id'))->update(['status' => $activestat,'gtr' => $computedgtr,'amf' => $amfs]);
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        // dd($formulareplaced);

        $request->session()->flash('success', 'Basic Education Membership has been Updated');
        
        return redirect()->route('bedmembership.index');
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
