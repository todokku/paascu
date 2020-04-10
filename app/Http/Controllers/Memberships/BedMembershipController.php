<?php

namespace App\Http\Controllers\Memberships;

use App\BedMembership;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Members;
use App\MembershipFormula;
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
        $members = Members::whereHas('programs', function ($query) {
        $query->whereIn('ed_level', ['Basic Education']);
        })
        ->whereHas('bedmembership', function ($query) {
        $query->whereIn('formula_id', ['Basic Education']);
        })
        ->get();

        $membershipids = BedMembership::select('variable_id')->groupBy('variable_id')->get();
        return view('admin.membershipfee.bed.index')->with('members',$members)->with('membershipids',$membershipids);

        // $members = Members::select('id','school')->whereHas('programs', function ($query) {
        // $query->whereIn('program', ['Basic Education']);
        // })
        // ->whereHas('membership', function ($query) {
        // $query->whereIn('formula_id', ['Basic Education']);
        // })
        // ->get();

        // $membership = Membership::all();
        // $variable = Variable::all();
        // $membershipids = Membership::select('variable_id')->groupBy('variable_id')->where('formula_id', 'Basic Education')->with('variables')->get();
        // $compute = Compute::all();

        // return view('admin.membershipfee.bed.index')->with('members',$members)->with('membership',$membership)->with('membershipids',$membershipids)->with('compute', $compute);
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
    public function edit($id , $content)
    {
        $memid = $id;
        $contid = $content;
        $school = Members::find($id);
        $membership = BedMembership::whereIn('member_id', [$id])->where('content_id', $content)->get();

        $compute = Compute::whereIn('member_id', [$id])->where('content_id', $content)->get();

        // dd($school);
        return view('admin.membershipfee.bed.edit')->with('membership', $membership)->with('compute',$compute[0])->with('school',$school)->with('memid',$memid)->with('contid',$contid);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BedMembership  $bedMembership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

//updating contents ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        $membership = BedMembership::whereIn('member_id', [$request->input('id')])->where('content_id', $request->input('cid'))->get();
        foreach($membership as $pihsrebmem){
        $bedupdate = BedMembership::find($pihsrebmem->id);
        $bedupdate->content = $request->input($pihsrebmem->id);
        $bedupdate->save();
        }

        //updating calculated values~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        $activestat = $request->input('status');
        $cformula = Formula::where('formula_id','Basic Education')->first();
        $cmembership = BedMembership::whereIn('member_id', [$request->input('id')])->where('content_id', $request->input('cid'))->get();

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
        $last_key = count($scheduled);
        $i = 0;
        foreach ($scheduled as $key=>$deludehcs){
        if(++$i === $last_key){
        if($deludehcs->gtrs <= $computedgtr){
            $amfs = $deludehcs->amf;        
        }
        break;
        }
//-----------------------------------------------        
        if($deludehcs->gtrs <= $computedgtr && $deludehcs->gtre >= $computedgtr){
            $amfs = $deludehcs->amf;
        }
        }
        // saving to compute~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        $cCompute = Compute::where('member_id', $request->input('id'))->where('content_id', $request->input('cid'))->update(['status' => $activestat,'gtr' => $computedgtr,'amf' => $amfs]);
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
