<?php

namespace App\Http\Controllers\Memberships;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Members;
use DB;
use App\ScheduleMembership;

use App\GedMembership;
use App\Variable;
use App\Compute;
use App\Formula;

use App\EnrolledProgram;
use App\EnrolledAcpagps;
use App\AccreditedGraduateProgram;
class GedtriMembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Members::select('id','school')->whereHas('programs', function ($query) {
        $query->whereIn('ed_level', ['Graduate Education']);
        })
        ->whereHas('gedmembership', function ($query) {
        $query->whereIn('formula_id', ['Graduate Education Trimester']);
        })
        ->get();

        $membershipids = GedMembership::select('variable_id')->groupBy('variable_id')->where('formula_id', 'Graduate Education Trimester')
        ->get();

        return view('main.membershipfee.gedtri.index')->with('members',$members)->with('membershipids',$membershipids);
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
    public function edit($id,$content)
    {
        $memid = $id;
        $contid = $content;
        $school = Members::find($id);
        $membership = GedMembership::whereIn('member_id', [$id])->where('content_id', $content)->get();


        $compute = Compute::whereIn('member_id', [$id])->where('content_id', $content)->get();

        $program = EnrolledProgram::whereIn('compute_id', [$content])->get();
        $agpall = AccreditedGraduateProgram::all();
        $agp = EnrolledAcpagps::whereIn('compute_id', [$content])->get();
        $agparrayx = array();
        foreach($agp as $arr){
        array_push($agparrayx, $arr->program);
        }
        $agpx = AccreditedGraduateProgram::whereIn('program', $agparrayx)->get();
        $agparray = array();
        foreach($agpx as $arr){
        array_push($agparray, $arr->id);
        }
        return view('main.membershipfee.gedtri.edit')->with('membership', $membership)->with('compute',$compute[0])->with('school',$school)->with('memid',$memid)->with('contid',$contid)->with('program',$program)->with('agpall',$agpall)->with('agparray',$agparray);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $programs = EnrolledProgram::whereIn('compute_id', [$request->input('cid')])->get();

        foreach($programs as $smargorp){
        $smargorp->semone = $request->input("f".$smargorp->id);
        $smargorp->semtwo = $request->input("s".$smargorp->id);
        $smargorp->semthree = $request->input("t".$smargorp->id);
        $smargorp->update();
        }

        $agp = EnrolledAcpagps::whereIn('compute_id', [$request->input('cid')])->delete();
        $selectedagps = $request->input('agpx');
        $exagp = explode(',', $selectedagps);
        $agpname = AccreditedGraduateProgram::whereIn('id', $exagp )->get();
        foreach($agpname as $agpnamex){
        $gedsemagpagps = new EnrolledAcpagps();
        $gedsemagpagps->compute_id = $request->input('cid');
        $gedsemagpagps->program = $agpnamex->program;
        $gedsemagpagps->ap_type = "agp";
        $gedsemagpagps->save();
        }

//updating contents ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        $membership = GedMembership::whereIn('member_id', [$request->input('id')])->where('content_id', $request->input('cid'))->get();
        foreach($membership as $pihsrebmem){
        $gedtriupdate = GedMembership::find($pihsrebmem->id);
        $gedtriupdate->content = $request->input($pihsrebmem->id);
        $gedtriupdate->save();
        }

        //updating calculated values~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        $activestat = $request->input('status');
        $cformula = Formula::where('formula_id','Graduate Education Trimester')->first();
        $cmembership = GedMembership::whereIn('member_id', [$request->input('id')])->where('content_id', $request->input('cid'))->get();

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

        $request->session()->flash('success', 'Graduate Education Trimester Membership has been Updated');
        
        return redirect()->route('gedtrimembership.index');
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
}
