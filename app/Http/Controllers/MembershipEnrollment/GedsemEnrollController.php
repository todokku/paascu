<?php

namespace App\Http\Controllers\MembershipEnrollment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

use App\Members;
use App\Formula;
use App\Variable;
use App\Programs;

use App\GedMembership;
use App\Compute;
use App\ScheduleMembership;
use App\AccreditedGraduateProgram;

use App\Membership;

use App\EnrolledProgram;
use App\EnrolledAcpagps;
class GedsemEnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
            $request->validate([
                'gedsemid' => 'required',
                'gedsemagp' => 'required',
                'gedsemprogram' => 'required'
            ], [
                'gedsemid.required' => 'School is required',
                'gedsemagp.required' => 'Accredited College Program is required',
                'gedsemprogram.required' => 'Programs is required'
            ]);

        $id = $request->input('gedsemid');
        
        $members = Members::find($id);

        $selectedagps = $request->input('gedsemagp');
        $exagp = explode(',', $selectedagps);
        $agp = AccreditedGraduateProgram::whereIn('id', $exagp)->get();

        $selectedprograms = $request->input('gedsemprogram');
        $expro = explode(',', $selectedprograms);
        $programs = Programs::whereIn('id', $expro)->get();

        $formula = Formula::where('formula_id','Graduate Education Semester')->first();
        $gedsempieces = explode(" ", $formula->formula);
        $variabled = Variable::whereIn('code',$gedsempieces)->where('ed_type', 'Graduate Education Semester')->get();

        return view('main.membershipenroll.gedsem.index')->with('members',$members)->with('formula',$formula)->with('gedsempieces',$gedsempieces)->with('variabled',$variabled)->with('agp',$agp)->with('programs',$programs)->with('selectedagps',$selectedagps)->with('selectedprograms',$selectedprograms);
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
        $selectedagps = $request->input('gedsemagp');
        $exagp = explode(',', $selectedagps);
        $agp = AccreditedGraduateProgram::whereIn('id', $exagp)->get();

        $selectedprograms = $request->input('gedsemprogram');
        $expro = explode(',', $selectedprograms);
        $programs = Programs::whereIn('id', $expro)->get();

        $meme = new Membership();
        $meme->member_id = $request->input('gedsemmember');
        $meme->save();
        $memeid = $meme->id;

       $formula = Formula::where('formula_id','Graduate Education Semester')->first();
        $gedsempieces = explode(" ", $formula->formula);
        $variabled = Variable::whereIn('code',$gedsempieces)->where('ed_type', 'Graduate Education Semester')->get();

        $formulareplaced = $formula->formula; //$formula->formula = ( gs_total_enrollment * gs_annual_tuition_fee )
        $amfs;
        foreach ($variabled as $delbairav){
        $gedsem = new GedMembership();
        $gedsem->member_id = $request->input('gedsemmember');
        $gedsem->formula_id = "Graduate Education Semester";

        // $gsm->fee_id = $request->input('gsmember');

        $gedsem->variable_id = $request->input("vari-".$delbairav->id);
        $gedsem->content = $request->input($delbairav->code);
        $gedsem->content_id = $memeid;
        $gedsem->save();
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

        $gedsemmcompute = new Compute();
        $gedsemmcompute->member_id = $request->input('gedsemmember');

        // $gsmcompute->fee_id = $request->input('gsmember');

        $gedsemmcompute->gtr = $computedgtr;
        $gedsemmcompute->amf = $amfs;
        $gedsemmcompute->formula_id = "Graduate Education Semester";
        $gedsemmcompute->content_id = $memeid;
        $gedsemmcompute->save();
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        $computeid = $gedsemmcompute->id;
        foreach($programs as $smargorp){
        $gedsemep = new EnrolledProgram();
        $gedsemep->compute_id = $computeid;
        $gedsemep->program = $smargorp->program;
        $gedsemep->semone = $request->input("f".$smargorp->id);
        $gedsemep->semtwo = $request->input("s".$smargorp->id);
        // $semthree = $request->input("t".$smargorp->id);
        $gedsemep->save();
        }
        foreach($agp as $pca){
        $gedsemagpagps = new EnrolledAcpagps();
        $gedsemagpagps->compute_id = $computeid;
        $gedsemagpagps->program = $pca->program;
        $gedsemagpagps->ap_type = "agp";
        $gedsemagpagps->save();
        }

        $request->session()->flash('success', 'Graduate Education Semester Membership has been Added');
        return redirect()->route('gedenrollment.index');
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
