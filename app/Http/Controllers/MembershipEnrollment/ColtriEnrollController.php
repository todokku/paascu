<?php

namespace App\Http\Controllers\MembershipEnrollment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

use App\Members;
use App\Formula;
use App\Variable;
use App\Programs;

use App\ColMembership;
use App\Compute;
use App\ScheduleMembership;
use App\AccreditedCollegeProgram;

use App\Membership;

use App\EnrolledProgram;
use App\EnrolledAcpagps;
class ColtriEnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {           $request->validate([
                'coltriid' => 'required',
                'coltriacp' => 'required',
                'coltriprogram' => 'required'
            ], [
                'coltriid.required' => 'School is required',
                'coltriacp.required' => 'Accredited College Program is required',
                'coltriprogram.required' => 'Programs is required'
            ]);
        $id = $request->input('coltriid');
        $members = Members::find($id);

        $selectedacps = $request->input('coltriacp');
        $exacp = explode(',', $selectedacps);
        $acp = AccreditedCollegeProgram::whereIn('id', $exacp)->get();

        $selectedprograms = $request->input('coltriprogram');
        $expro = explode(',', $selectedprograms);
        $programs = Programs::whereIn('id', $expro)->get();

        $formula = Formula::where('formula_id','College Trimester')->first();
        $coltripieces = explode(" ", $formula->formula);
        $variabled = Variable::whereIn('code',$coltripieces)->where('ed_type', 'College Trimester')->get();

        return view('main.membershipenroll.coltri.index')->with('members',$members)->with('formula',$formula)->with('coltripieces',$coltripieces)->with('variabled',$variabled)->with('acp',$acp)->with('programs',$programs)->with('selectedacps',$selectedacps)->with('selectedprograms',$selectedprograms);
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
        $selectedacps = $request->input('coltriacp');
        $exacp = explode(',', $selectedacps);
        $acp = AccreditedCollegeProgram::whereIn('id', $exacp)->get();

        $selectedprograms = $request->input('coltriprogram');
        $expro = explode(',', $selectedprograms);
        $programs = Programs::whereIn('id', $expro)->get();

        $meme = new Membership();
        $meme->member_id = $request->input('coltrimember');
        $meme->save();
        $memeid = $meme->id;

       $formula = Formula::where('formula_id','College Trimester')->first();
        $coltripieces = explode(" ", $formula->formula);
        $variabled = Variable::whereIn('code',$coltripieces)->where('ed_type', 'College Trimester')->get();

        $formulareplaced = $formula->formula; //$formula->formula = ( gs_total_enrollment * gs_annual_tuition_fee )
        $amfs;
        foreach ($variabled as $delbairav){
        $coltri = new ColMembership();
        $coltri->member_id = $request->input('coltrimember');
        $coltri->formula_id = "College Trimester";

        // $gsm->fee_id = $request->input('gsmember');

        $coltri->variable_id = $request->input("vari-".$delbairav->id);
        $coltri->content = $request->input($delbairav->code);
        $coltri->content_id = $memeid;
        $coltri->save();
        }

        //replaceing form input into given formula;~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        foreach ($variabled as $delbairav){
        $formulareplaced =   str_replace($delbairav->code,$request->input($delbairav->code),$formulareplaced);
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

        $coltrimcompute = new Compute();
        $coltrimcompute->member_id = $request->input('coltrimember');

        // $gsmcompute->fee_id = $request->input('gsmember');

        $coltrimcompute->gtr = $computedgtr;
        $coltrimcompute->amf = $amfs;
        $coltrimcompute->formula_id = "College Trimester";
        $coltrimcompute->content_id = $memeid;
        $coltrimcompute->save();
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        $computeid = $coltrimcompute->id;
        foreach($programs as $smargorp){
        $coltriep = new EnrolledProgram();
        $coltriep->compute_id = $computeid;
        $coltriep->program = $smargorp->program;
        $coltriep->semone = $request->input("f".$smargorp->id);
        $coltriep->semtwo = $request->input("s".$smargorp->id);
        $coltriep->semthree = $request->input("t".$smargorp->id);
        $coltriep->save();
        }
        foreach($acp as $pca){
        $coltriacpagps = new EnrolledAcpagps();
        $coltriacpagps->compute_id = $computeid;
        $coltriacpagps->program = $pca->program;
        $coltriacpagps->ap_type = "acp";
        $coltriacpagps->save();
        }

        $request->session()->flash('success', 'College Trimester Membership has been Added');
        return redirect()->route('colenrollment.index');
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
}
