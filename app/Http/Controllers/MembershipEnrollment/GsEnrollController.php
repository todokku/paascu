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
class GsEnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $members = Members::select('id','school')->whereHas('programs', function ($query) {
        $query->whereIn('program', ['Grade School']);
        })->get();

        $formula = Formula::where('formula_id','Grade School')->first();
        $gspieces = explode(" ", $formula->formula);
        $variabled = Variable::whereIn('code',$gspieces)->get();
        return view('admin.membershipenroll.gs.index')->with('members',$members)->with('formula',$formula)->with('gspieces',$gspieces)->with('variabled',$variabled);
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
        $formula = Formula::where('formula_id','Grade School')->first();
        $gspieces = explode(" ", $formula->formula);
        $variabled = Variable::whereIn('code',$gspieces)->get();

        $formulareplaced = $formula->formula; //$formula->formula = ( gs_total_enrollment * gs_annual_tuition_fee )
        foreach ($variabled as $delbairav){
        $gsm = new Membership();
        $gsm->member_id = $request->input('gsmember');
        $gsm->formula_id = "Grade School";
        $gsm->variable_id = $request->input("vari-".$delbairav->id);
        $gsm->content = $request->input($delbairav->code);
        $gsm->save();
        }

        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        //replaceing form input into given formula;~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        // foreach ($variabled as $delbairav){
        // $formulareplaced =   str_replace($delbairav->code,$request->input($delbairav->code),$formulareplaced);
        // }
        // echo $formulareplaced;~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        // computing the current formula~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        // $gsmcompute = new Compute();
        // $gsmcompute->member_id = $request->input('gsmember');
        // $gsmcompute->gtr = eval("return $formulareplaced;");
        // $gsmcompute->amf = 404;
        // $gsmcompute->save();
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
