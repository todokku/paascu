<?php

namespace App\Http\Controllers\Memberships;

use App\GsMembership;
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
class GsMembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Members::whereHas('programs', function ($query) {
        $query->whereIn('ed_level', ['Grade School']);
        })
        ->whereHas('gsmembership', function ($query) {
        $query->whereIn('formula_id', ['Grade School']);
        })
        ->get();

        $membershipids = GsMembership::select('variable_id')->groupBy('variable_id')->get();
        return view('admin.membershipfee.gs.index')->with('members',$members)->with('membershipids',$membershipids);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {

    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    // }

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
    public function edit($id, $content)
    {   $memid = $id;
        $contid = $content;
        $school = Members::find($id);


        $membership = GsMembership::whereIn('member_id', [$id])->where('content_id', $content)->get();

        $compute = Compute::whereIn('member_id', [$id])->where('content_id', $content)->get();

        // echo($compute[0]);
        return view('admin.membershipfee.gs.edit')->with('membership', $membership)->with('compute',$compute[0])->with('school',$school)->with('memid',$memid)->with('contid',$contid);
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
        $membership = GsMembership::whereIn('member_id', [$request->input('id')])->where('content_id', $request->input('cid'))->get();
        foreach($membership as $pihsrebmem){
        $gsupdate = GsMembership::find($pihsrebmem->id);
        $gsupdate->content = $request->input($pihsrebmem->id);
        $gsupdate->save();
        }

        //updating calculated values~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        $activestat = $request->input('status');
        $cformula = Formula::where('formula_id','Grade School')->first();
        $cmembership = GsMembership::whereIn('member_id', [$request->input('id')])->where('content_id', $request->input('cid'))->get();

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
        $cCompute = Compute::whereIn('member_id', [$request->input('id')])->where('content_id', $request->input('cid'))->update(['status' => $activestat,'gtr' => $computedgtr,'amf' => $amfs]);
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
    // public function destroy(GsMembership $gsmembership)
    // {
    //     //
    // }

    // public function formulagroup(Request $request)
    // {
        // $id= $request->id;
        // $data = DB::table('gs_memberships')->whereIn('member_id', [$id])->get();
        // echo json_encode($data);

    // }
}
