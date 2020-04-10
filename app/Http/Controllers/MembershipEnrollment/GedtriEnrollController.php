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
class GedtriEnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->input('gedtriid');

        $members = Members::find($id);

        $programs = Programs::where('member_id', $id)->whereIn('ed_level', ['Graduate Education'])->get();

        $acp = AccreditedGraduateProgram::all();

        $formula = Formula::where('formula_id','Graduate Education Trimester')->first();
        $gedtripieces = explode(" ", $formula->formula);
        $variabled = Variable::whereIn('code',$gedtripieces)->where('ed_type', 'Graduate Education Trimester')->get();

        return view('admin.membershipenroll.gedtri.index')->with('members',$members)->with('formula',$formula)->with('gedtripieces',$gedtripieces)->with('variabled',$variabled)->with('acp',$acp)->with('programs',$programs);
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
        $meme->member_id = $request->input('gedtrimember');
        $meme->save();
        $memeid = $meme->id;

       $formula = Formula::where('formula_id','Graduate Education Trimester')->first();
        $gedtripieces = explode(" ", $formula->formula);
        $variabled = Variable::whereIn('code',$gedtripieces)->where('ed_type', 'Graduate Education Trimester')->get();

        $formulareplaced = $formula->formula; //$formula->formula = ( gs_total_enrollment * gs_annual_tuition_fee )
        $amfs;
        foreach ($variabled as $delbairav){
        $gedtri = new GedMembership();
        $gedtri->member_id = $request->input('gedtrimember');
        $gedtri->formula_id = "Graduate Education Trimester";

        // $gsm->fee_id = $request->input('gsmember');

        $gedtri->variable_id = $request->input("vari-".$delbairav->id);
        $gedtri->content = $request->input($delbairav->code);
        $gedtri->content_id = $memeid;
        $gedtri->save();
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

        $gedtrimcompute = new Compute();
        $gedtrimcompute->member_id = $request->input('gedtrimember');

        // $gsmcompute->fee_id = $request->input('gsmember');

        $gedtrimcompute->gtr = $computedgtr;
        $gedtrimcompute->amf = $amfs;
        $gedtrimcompute->formula_id = "Graduate Education Trimester";
        $gedtrimcompute->content_id = $memeid;
        $gedtrimcompute->save();
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        $request->session()->flash('success', 'Graduate Education Trimester Membership has been Added');
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
