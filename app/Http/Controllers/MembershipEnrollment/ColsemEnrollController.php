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
use App\AccreditedCollegeProgram;

class ColsemEnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   $id = $request->input('colsemid');
 
        $members = Members::find($id);
        // foreach ($members->programs as $qwe) {
        // echo $qwe->program;
        // }


        // $members = Members::select('id','school')->whereHas('programs', function ($query) {
        // $query->whereIn('ed_level', ['College']);
        // })->get();

        $acp = AccreditedCollegeProgram::all();

        $formula = Formula::where('formula_id','College Semester')->first();
        $colsempieces = explode(" ", $formula->formula);
        $variabled = Variable::whereIn('code',$colsempieces)->where('ed_type', 'College Semester')->get();

        return view('admin.membershipenroll.colsem.index')->with('members',$members)->with('formula',$formula)->with('colsempieces',$colsempieces)->with('variabled',$variabled)->with('acp',$acp);
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
       $formula = Formula::where('formula_id','College Semester')->first();
        $colsempieces = explode(" ", $formula->formula);
        $variabled = Variable::whereIn('code',$colsempieces)->where('ed_type', 'College Semester')->get();

        $formulareplaced = $formula->formula; //$formula->formula = ( gs_total_enrollment * gs_annual_tuition_fee )
        $amfs;
        foreach ($variabled as $delbairav){
        $colsem = new Membership();
        $colsem->member_id = $request->input('colsemmember');
        $colsem->formula_id = "College Semester";

        // $gsm->fee_id = $request->input('gsmember');

        $colsem->variable_id = $request->input("vari-".$delbairav->id);
        $colsem->content = $request->input($delbairav->code);
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
        foreach ($scheduled as $deludehcs){
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
        $colsemmcompute->save();
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        $request->session()->flash('success', 'College Semester Membership has been Added');
        return redirect()->route('colsemenrollment.index');
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
