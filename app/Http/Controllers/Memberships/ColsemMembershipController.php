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

class ColsemMembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Members::select('id','school')->whereHas('programs', function ($query) {
        $query->whereIn('ed_level', ['College']);
        })
        ->whereHas('membership', function ($query) {
        $query->whereIn('formula_id', ['College Semester']);
        })
        ->get();

        $membership = Membership::all();
        $variable = Variable::all();
        $membershipids = Membership::select('variable_id')->groupBy('variable_id')->where('formula_id', 'College Semester')
        ->get();
        $compute = Compute::all();

        return view('admin.membershipfee.colsem.index')->with('members',$members)->with('membership',$membership)->with('membershipids',$membershipids)->with('compute', $compute);


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
        $memid = $id;
        $school = Members::find($id);
        $membership = Membership::whereIn('member_id', [$id])->get();

        $compute = Compute::where('member_id', $id)->first();

        // dd($school);
        return view('admin.membershipfee.colsem.edit')->with('membership', $membership)->with('compute',$compute)->with('school',$school)->with('memid',$memid);
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
        //updating contents ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        $membership = Membership::whereIn('member_id', [$request->input('id')])->get();
        foreach($membership as $pihsrebmem){
        $colsemupdate = Membership::find($pihsrebmem->id);
        $colsemupdate->content = $request->input($pihsrebmem->id);
        $colsemupdate->save();
        }

        //updating calculated values~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        $activestat = $request->input('status');
        $cformula = Formula::where('formula_id','College Semester')->first();
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

        $request->session()->flash('success', 'College Semester Membership has been Updated');
        
        return redirect()->route('colsemmembership.index');
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
