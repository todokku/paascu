<?php

namespace App\Http\Controllers\MembershipEnrollment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

use App\Members;
use App\Formula;
use App\Variable;
use App\Programs;

use App\GsMembership;
use App\Compute;
use App\ScheduleMembership;

use App\Membership;
class GsEnrollController extends Controller
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
        })->get();

        $formula = Formula::where('formula_id','Grade School')->first();
        $gspieces = explode(" ", $formula->formula);
        $variabled = Variable::whereIn('code',$gspieces)->where('ed_type', 'Grade School')->get();
        return view('main.membershipenroll.gs.index')->with('members',$members)->with('formula',$formula)->with('gspieces',$gspieces)->with('variabled',$variabled);
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
//testing ------------------------------------------------------
        $meme = new Membership();
        $meme->member_id = $request->input('gsmember');
        $meme->save();
        $memeid = $meme->id;
//testing ------------------------------------------------------
        $formula = Formula::where('formula_id','Grade School')->first();
        $gspieces = explode(" ", $formula->formula);
        $variabled = Variable::whereIn('code',$gspieces)->where('ed_type', 'Grade School')->get();

        $formulareplaced = $formula->formula; //$formula->formula = ( gs_total_enrollment * gs_annual_tuition_fee )
        $amfs;
        foreach ($variabled as $delbairav){
        $gsm = new GsMembership();
        $gsm->member_id = $request->input('gsmember');
        $gsm->formula_id = "Grade School";

        // $gsm->fee_id = $request->input('gsmember');

        $gsm->variable_id = $request->input("vari-".$delbairav->id);
        $gsm->content = $request->input($delbairav->code);
//testing ------------------------------------------------------
        $gsm->content_id = $memeid;
//testing ------------------------------------------------------
        $gsm->save();
        }

        //replaceing form input into given formula;~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        foreach ($variabled as $delbairav){
        $formulareplaced =   str_replace($delbairav->code,$request->input($delbairav->code),$formulareplaced);
        }
        //time to compute the skyline gtr 
        $computedgtr = eval("return $formulareplaced;");
        //finding AMF via schedule start and end values ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        $scheduled = ScheduleMembership::all();
//-----------------------------------------------
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

        $gsmcompute = new Compute();
        $gsmcompute->member_id = $request->input('gsmember');

        // $gsmcompute->fee_id = $request->input('gsmember');

        $gsmcompute->gtr = $computedgtr;
        $gsmcompute->amf = $amfs;
        $gsmcompute->formula_id = "Grade School";
//testing ------------------------------------------------------
        $gsmcompute->content_id = $memeid;
//testing ------------------------------------------------------
        $gsmcompute->save();
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        $request->session()->flash('success', 'Grade School Membership has been Added');
        return redirect()->route('gsenrollment.index');
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
