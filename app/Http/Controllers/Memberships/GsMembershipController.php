<?php

namespace App\Http\Controllers\Memberships;

use App\GsMembership;
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
class GsMembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $formula = MembershipFormula::where('ed_type','Grade School')->first();
        // $membership = GsMembership::select('id', 'member_id', 'title', 'content', 'position', 'gtr')->groupBy('member_id')->get();
        // $pieces = explode(" ", $formula->variable); 
        // $sm = ScheduleMembership::all();
        // return view('admin.membershipfee.gs.index')->with('membership', $membership)->with('formula', $formula)->with('pieces', $pieces)->with( 'sm' , $sm );

        $members = Members::select('id','school')->whereHas('programs', function ($query) {
        $query->whereIn('program', ['Grade School']);
        })->get();

        $membership = Membership::all();
        $variable = Variable::all();
        $membershipids = Membership::select('variable_id')->groupBy('variable_id')->where('formula_id', 'Grade School')->with('variables')->get();
        $compute = Compute::all();

        // dd($membershipids);
        return view('admin.membershipfee.gs.index')->with('members',$members)->with('membership',$membership)->with('membershipids',$membershipids)->with('compute', $compute);
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
    public function edit($id)
    {   $memid = $id;
        $school = Members::find($id);
        $membership = Membership::whereIn('member_id', [$id])->get();

        $compute = Compute::where('member_id', $id)->first();

        // dd($school);
        return view('admin.membershipfee.gs.edit')->with('membership', $membership)->with('compute',$compute)->with('school',$school)->with('memid',$memid);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gshsmembership  $gshsmembership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //updating contents ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        $membership = Membership::whereIn('member_id', [$request->input('id')])->get();
        foreach($membership as $pihsrebmem){
        $gsupdate = Membership::find($pihsrebmem->id);
        $gsupdate->content = $request->input($pihsrebmem->id);
        $gsupdate->save();
        }

        //updating calculated values~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        $activestat = $request->input('status');
        $cformula = Formula::where('formula_id','Grade School')->first();
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

        $request->session()->flash('success', 'Grade School Membership has been Updated');
        
        return redirect()->route('gsmembership.index');
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

    public function formulagroup(Request $request)
    {
        $id= $request->id;
        $data = DB::table('gs_memberships')->whereIn('member_id', [$id])->get();
        echo json_encode($data);

    }
}
