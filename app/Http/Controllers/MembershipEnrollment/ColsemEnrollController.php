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
class ColsemEnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   // =======================================================
           $request->validate([
                'colsemid' => 'required',
                'colsemacp' => 'required',
                'colsemprogram' => 'required'
            ], [
                'colsemid.required' => 'School is required',
                'colsemacp.required' => 'Accredited College Program is required',
                'colsemprogram.required' => 'Programs is required'
            ]);

        $id = $request->input('colsemid');
        $members = Members::find($id);

        $selectedacps = $request->input('colsemacp');
        $exacp = explode(',', $selectedacps);
        $acp = AccreditedCollegeProgram::whereIn('id', $exacp)->get();

        $selectedprograms = $request->input('colsemprogram');
        $expro = explode(',', $selectedprograms);
        $programs = Programs::whereIn('id', $expro)->get();

        $formula = Formula::where('formula_id','College Semester')->first();
        $colsempieces = explode(" ", $formula->formula);
        $variabled = Variable::whereIn('code',$colsempieces)->where('ed_type', 'College Semester')->get();

        return view('main.membershipenroll.colsem.index')->with('members',$members)->with('formula',$formula)->with('colsempieces',$colsempieces)->with('variabled',$variabled)->with('acp',$acp)->with('programs',$programs)->with('selectedacps',$selectedacps)->with('selectedprograms',$selectedprograms);
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
        // =======================================================
        $selectedacps = $request->input('colsemacp');
        $exacp = explode(',', $selectedacps);
        $acp = AccreditedCollegeProgram::whereIn('id', $exacp)->get();

        $selectedprograms = $request->input('colsemprogram');
        $expro = explode(',', $selectedprograms);
        $programs = Programs::whereIn('id', $expro)->get();

        //make table make one to many make id of created compute input in column

        // =======================================================

        $meme = new Membership();
        $meme->member_id = $request->input('colsemmember');
        $meme->save();
        $memeid = $meme->id;

       $formula = Formula::where('formula_id','College Semester')->first();
        $colsempieces = explode(" ", $formula->formula);
        $variabled = Variable::whereIn('code',$colsempieces)->where('ed_type', 'College Semester')->get();

        $formulareplaced = $formula->formula; //$formula->formula = ( gs_total_enrollment * gs_annual_tuition_fee )
        $amfs;
        foreach ($variabled as $delbairav){
        $colsem = new ColMembership();
        $colsem->member_id = $request->input('colsemmember');
        $colsem->formula_id = "College Semester";

        // $gsm->fee_id = $request->input('gsmember');

        $colsem->variable_id = $request->input("vari-".$delbairav->id);
        $colsem->content = $request->input($delbairav->code);
        $colsem->content_id = $memeid;
        $colsem->save();
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

        $colsemmcompute = new Compute();
        $colsemmcompute->member_id = $request->input('colsemmember');

        // $gsmcompute->fee_id = $request->input('gsmember');

        $colsemmcompute->gtr = $computedgtr;
        $colsemmcompute->amf = $amfs;
        $colsemmcompute->formula_id = "College Semester";
        $colsemmcompute->content_id = $memeid;
        $colsemmcompute->save();
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        // =======================================================
        $computeid = $colsemmcompute->id;
        foreach($programs as $smargorp){
        $colsemep = new EnrolledProgram();
        $colsemep->compute_id = $computeid;
        $colsemep->program = $smargorp->program;
        $colsemep->semone = $request->input("f".$smargorp->id);
        $colsemep->semtwo = $request->input("s".$smargorp->id);
        // $semthree = $request->input("t".$smargorp->id);
        $colsemep->save();
        }
        foreach($acp as $pca){
        $colsemacpagps = new EnrolledAcpagps();
        $colsemacpagps->compute_id = $computeid;
        $colsemacpagps->program = $pca->program;
        $colsemacpagps->ap_type = "acp";
        $colsemacpagps->save();
        }

        // =======================================================

        $request->session()->flash('success', 'College Semester Membership has been Added');
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
