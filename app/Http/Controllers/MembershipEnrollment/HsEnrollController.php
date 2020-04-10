<?php

namespace App\Http\Controllers\MembershipEnrollment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

use App\Members;
use App\Formula;
use App\Variable;
use App\Programs;

use App\HsMembership;
use App\Compute;
use App\ScheduleMembership;

class HsEnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $members = Members::whereHas('programs', function ($query) {
        $query->whereIn('ed_level', ['High School']);
        })->get();

        $formula = Formula::where('formula_id','High School')->first();
        $hspieces = explode(" ", $formula->formula);
        $variabled = Variable::whereIn('code',$hspieces)->where('ed_type', 'High School')->get();
        return view('admin.membershipenroll.hs.index')->with('members',$members)->with('formula',$formula)->with('hspieces',$hspieces)->with('variabled',$variabled);



        // $members = Members::select('id','school')->whereHas('programs', function ($query) {
        // $query->whereIn('program', ['High School']);
        // })->get();

        // $formula = Formula::where('formula_id','High School')->first();
        // $gspieces = explode(" ", $formula->formula);
        // $variabled = Variable::whereIn('code',$gspieces)->where('ed_type', 'High School')->get();
        // return view('admin.membershipenroll.hs.index')->with('members',$members)->with('formula',$formula)->with('gspieces',$gspieces)->with('variabled',$variabled);
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
        $formula = Formula::where('formula_id','High School')->first();
        $hspieces = explode(" ", $formula->formula);
        $variabled = Variable::whereIn('code',$hspieces)->where('ed_type', 'High School')->get();

        $formulareplaced = $formula->formula; //$formula->formula = ( gs_total_enrollment * gs_annual_tuition_fee )
        $amfs;
        foreach ($variabled as $delbairav){
        $hsm = new HsMembership();
        $hsm->member_id = $request->input('hsmember');
        $hsm->formula_id = "High School";

        // $gsm->fee_id = $request->input('gsmember');

        $hsm->variable_id = $request->input("vari-".$delbairav->id);
        $hsm->content = $request->input($delbairav->code);
        $hsm->save();
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

        $hsmcompute = new Compute();
        $hsmcompute->member_id = $request->input('hsmember');

        // $gsmcompute->fee_id = $request->input('gsmember');
        $hsmcompute->formula_id = "High School";
        $hsmcompute->gtr = $computedgtr;
        $hsmcompute->amf = $amfs;
        $hsmcompute->save();
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        $request->session()->flash('success', 'High School Membership has been Added');
        return redirect()->route('hsenrollment.index');
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
