<?php

namespace App\Http\Controllers\MembershipEnrollment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

use App\Members;
use App\Formula;
use App\Variable;
use App\Programs;

use App\Membership;
use App\Compute;
use App\ScheduleMembership;
use App\AccreditedGraduateProgram;

class GedsemEnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->input('gedsemid');
        $members = Members::find($id);

        // $pros = Programs::whereIn('ed_level', ['Graduate Education'])->get();

        // $members = Members::find($id)->whereHas('programs', function ($query) {
        // $query->whereIn('ed_level', ['Graduate Education']);
        // })->get();

        $programs = Programs::where('member_id', $id)->whereIn('ed_level', ['Graduate Education'])->get();
        // $progamu = DB::table('pwbs')->whereIn('code',  $codeArray)->where('project_id', $id)

        $acp = AccreditedGraduateProgram::all();
        $formula = Formula::where('formula_id','Graduate Education Semester')->first();
        $gedsempieces = explode(" ", $formula->formula);
        $variabled = Variable::whereIn('code',$gedsempieces)->where('ed_type', 'Graduate Education Semester')->get();
        return view('admin.membershipenroll.gedsem.index')->with('members',$members)->with('formula',$formula)->with('gedsempieces',$gedsempieces)->with('variabled',$variabled)->with('acp',$acp)->with('programs',$programs);

// foreach ($progamu as $cpa) {
// echo $cpa->program;
// }
        // dd($progamu);
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
       $formula = Formula::where('formula_id','Graduate Education Semester')->first();
        $gedsempieces = explode(" ", $formula->formula);
        $variabled = Variable::whereIn('code',$gedsempieces)->where('ed_type', 'Graduate Education Semester')->get();

        $formulareplaced = $formula->formula; //$formula->formula = ( gs_total_enrollment * gs_annual_tuition_fee )
        $amfs;
        foreach ($variabled as $delbairav){
        $gedsem = new Membership();
        $gedsem->member_id = $request->input('gedsemmember');
        $gedsem->formula_id = "Graduate Education Semester";

        // $gsm->fee_id = $request->input('gsmember');

        $gedsem->variable_id = $request->input("vari-".$delbairav->id);
        $gedsem->content = $request->input($delbairav->code);
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
        foreach ($scheduled as $deludehcs){
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
        $gedsemmcompute->save();
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
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