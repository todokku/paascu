<?php

namespace App\Http\Controllers\Memberships;

use App\HsMembership;
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

class HsMembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   //old

        $members = Members::select('id','school')->whereHas('programs', function ($query) {
        $query->whereIn('program', ['High School']);
        })
        ->whereHas('membership', function ($query) {
        $query->whereIn('formula_id', ['High School']);
        })
        ->get();

        $membership = Membership::all();
        $variable = Variable::all();
        $membershipids = Membership::select('variable_id')->groupBy('variable_id')->where('formula_id', 'High School')->with('variables')->get();
        $compute = Compute::all();

        // dd($membershipids);
        return view('admin.membershipfee.hs.index')->with('members',$members)->with('membership',$membership)->with('membershipids',$membershipids)->with('compute', $compute);
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
    public function edit($id)
    {
        $memid = $id;
        $school = Members::find($id);
        $membership = Membership::whereIn('member_id', [$id])->get();

        $compute = Compute::where('member_id', $id)->first();

        // dd($school);
        return view('admin.membershipfee.hs.edit')->with('membership', $membership)->with('compute',$compute)->with('school',$school)->with('memid',$memid);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HsMembership  $hsMembership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
//updating contents ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        $membership = Membership::whereIn('member_id', [$request->input('id')])->get();
        foreach($membership as $pihsrebmem){
        $hsupdate = Membership::find($pihsrebmem->id);
        $hsupdate->content = $request->input($pihsrebmem->id);
        $hsupdate->save();
        }

        //updating calculated values~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        $activestat = $request->input('status');
        $cformula = Formula::where('formula_id','High School')->first();
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

        $request->session()->flash('success', 'High School Membership has been Updated');
        
        return redirect()->route('hsmembership.index');
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
