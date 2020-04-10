<?php

namespace App\Http\Controllers\MembershipEnrollment;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

use App\Members;
use App\Formula;
use App\Variable;
use App\Programs;

use App\BedMembership;
use App\Compute;
use App\ScheduleMembership;

use App\Membership;
class BedEnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Members::whereHas('programs', function ($query) {
        $query->whereIn('ed_level', ['Basic Education']);
        })->get();

        $formula = Formula::where('formula_id','Basic Education')->first();
        $bedpieces = explode(" ", $formula->formula);
        $variabled = Variable::whereIn('code',$bedpieces)->where('ed_type', 'Basic Education')->get();
        return view('admin.membershipenroll.bed.index')->with('members',$members)->with('formula',$formula)->with('bedpieces',$bedpieces)->with('variabled',$variabled);




        // $members = Members::select('id','school')->whereHas('programs', function ($query) {
        // $query->whereIn('program', ['Basic Education']);
        // })->get();

        // $formula = Formula::where('formula_id','Basic Education')->first();
        // $gspieces = explode(" ", $formula->formula);
        // $variabled = Variable::whereIn('code',$gspieces)->where('ed_type', 'Basic Education')->get();
        // return view('admin.membershipenroll.bed.index')->with('members',$members)->with('formula',$formula)->with('gspieces',$gspieces)->with('variabled',$variabled);
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
        $meme = new Membership();
        $meme->member_id = $request->input('bedmember');
        $meme->save();
        $memeid = $meme->id;

        $formula = Formula::where('formula_id','Basic Education')->first();
        $bedpieces = explode(" ", $formula->formula);
        $variabled = Variable::whereIn('code',$bedpieces)->where('ed_type', 'Basic Education')->get();

        $formulareplaced = $formula->formula; //$formula->formula = ( gs_total_enrollment * gs_annual_tuition_fee )
        $amfs;
        foreach ($variabled as $delbairav){
        $bedm = new BedMembership();
        $bedm->member_id = $request->input('bedmember');
        $bedm->formula_id = "Basic Education";

        // $gsm->fee_id = $request->input('gsmember');

        $bedm->variable_id = $request->input("vari-".$delbairav->id);
        $bedm->content = $request->input($delbairav->code);
        $bedm->content_id = $memeid;
        $bedm->save();
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

        $bedmcompute = new Compute();
        $bedmcompute->member_id = $request->input('bedmember');

        // $gsmcompute->fee_id = $request->input('gsmember');
        $bedmcompute->formula_id = "Basic Education";
        $bedmcompute->gtr = $computedgtr;
        $bedmcompute->amf = $amfs;
        $bedmcompute->content_id = $memeid;
        $bedmcompute->save();
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        $request->session()->flash('success', 'Basic Education Membership has been Added');
        return redirect()->route('bedenrollment.index');
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
