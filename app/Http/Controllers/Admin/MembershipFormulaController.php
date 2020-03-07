<?php

namespace App\Http\Controllers\Admin;
//old shit
// use App\MembershipFormula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

use App\Formula;
use App\Variable;

use App\Membership;

class MembershipFormulaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   //oldshit
       //  $formula = MembershipFormula::all();
       // return view('admin.membershipformula.index')->with('formula', $formula);

 $formula = Formula::all();
return view('admin.membershipformula.index')->with('formula', $formula);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MembershipFormula  $membershipFormula
     * @return \Illuminate\Http\Response
     */
    public function show(MembershipFormula $membershipFormula)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MembershipFormula  $membershipFormula
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $ed_type)
    {
        $variable = Variable::whereIn('ed_type', [$ed_type])->get();
        $formula = Formula::find($id);
        return view('admin.membershipformula.edit')->with('formula',$formula)->with('variable',$variable);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MembershipFormula  $membershipFormula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $formula)
    {


//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//find differences get the differences (variable ids @ memberships)
$membership = Membership::select('variable_id')->whereIn('formula_id', [$request->input('ed_type')])->get();
$newarra = array();
foreach ($membership as $membershipx) {
        if(!in_array($membershipx->variable_id, $newarra, true)){
    array_push($newarra, $membershipx->variable_id);
    }
}
$newvari = $request->input('newvari');
$exvari = explode(" ", $newvari);
$thedifference = array_diff($newarra, $exvari); //TRUE OLD > new
$thedifference2 = array_diff($exvari,$newarra); //true old < NEW
// $mergeDifference = array_merge($thedifference, $thedifference2); 
if(!empty($thedifference)){
    //delete begins here
Membership::whereIn('variable_id', $thedifference)->where('formula_id', $request->input('ed_type'))->delete();

}elseif(!empty($thedifference2)){
$membershipids = Membership::select('member_id')->groupBy('member_id')->get();
foreach($membershipids as $msi1){ 
foreach($thedifference2 as $td2){ 
Membership::whereIn('variable_id', $thedifference2)->where('formula_id', $request->input('ed_type'))->create(
[
'member_id' => $msi1->member_id,
'formula_id' => $request->input('ed_type'),
'variable_id' => $td2,
'content' => 0
]

);
}
}
}
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~       
        // save starts here
        $formula = Formula::find($request->input('id'));
        $formula->formula = $request->input('newformula');
        if($formula->save()){
        $request->session()->flash('success', 'Formula has been Updated');
        }else{
        $request->session()->flash('error', 'Error in Formula Update');
        }
        return back();
    }

        public function updatevariable(Request $request)
    {
        $vari = new Variable();
        $vari->code = $request->input('newvariable');
        $vari->title = $request->input('newvartitle');
        $vari->ed_type = $request->input('newvared_type');
        if($vari->save()){
        $request->session()->flash('success', 'Variable has been Added');
        }else{
        $request->session()->flash('error', 'Error in Adding Variable');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MembershipFormula  $membershipFormula
     * @return \Illuminate\Http\Response
     */
    public function destroy(MembershipFormula $membershipFormula)
    {
        //
    }
}
