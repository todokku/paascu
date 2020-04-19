<?php

namespace App\Http\Controllers;
//old shit
// use App\MembershipFormula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

use App\Formula;
use App\Variable;

use App\ScheduleMembership;
use App\Compute;

use App\GsMembership;
use App\HsMembership;
use App\BedMembership;
use App\ColMembership;
use App\GedMembership;
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
return view('main.membershipformula.index')->with('formula', $formula);
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
        return view('main.membershipformula.edit')->with('formula',$formula)->with('variable',$variable);
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
    // $membership = Membership::select('variable_id')->whereIn('formula_id', [$request->input('ed_type')])->get();
    $eddytype = $request->input('ed_type');

    switch ($eddytype) {
        case "Grade School":
        $gsmembership = GsMembership::select('variable_id')->whereIn('formula_id', [$request->input('ed_type')])->get();
        $newarra = array(); //format of $newarra is array [0 => 1 1 => 2]
        //getting all the variable id's (non repeating ones)
            foreach ($gsmembership as $membershipx) {
                if(!in_array($membershipx->variable_id, $newarra, true)){
                array_push($newarra, $membershipx->variable_id);
                }
            }
        //newvari is the custom formula (the format is in id's of selected variables ie. "gs_total_enrollment" in 'id' compiled into one)
        //ex "1 2 20" "technically compilation of variable id's"
        $newvari = $request->input('newvari');
        //now we explode
        //now in array date_format ie [  0 => "1" 1 => "2" 2 => "20"]
        $exvari = explode(" ", $newvari);
        //finding differences between $newarra and $exvari
        // original                        gs_total_enrollment * gs_annual_tuition_fee
        // $thedifference  [   1 => 2    ] gs_total_enrollment * test_varaible_fee
        // $thedifference2 [   2 => "20" ] gs_total_enrollment * gs_annual_tuition_fee + test_varaible_fee 
        $thedifference = array_diff($newarra, $exvari); //TRUE OLD > new       
        $thedifference2 = array_diff($exvari,$newarra); //true old < NEW 
        if(!empty($thedifference)){
            //delete begins here
            GsMembership::whereIn('variable_id', $thedifference)->delete();
            // need to get the contents from each ed_type
            //then calculate and this below
        }elseif(!empty($thedifference2)){
            // $membershipids returns member_ids of gs based on content id
            $membershipids = GsMembership::select('member_id', 'content_id')->groupBy('content_id')->where('formula_id', $request->input('ed_type'))->get();
                foreach($membershipids as $msi1){ 
                    foreach($thedifference2 as $td2){ 
                    //getting value of variable to input
                    $vardefvalue = Variable::where('id',$td2)->first();
                    //adding new row to gs_membership
                    GsMembership::whereIn('variable_id', $thedifference2)->where('formula_id', $request->input('ed_type'))->create([
                        'member_id' => $msi1->member_id,
                        'formula_id' => $request->input('ed_type'),
                        'variable_id' => $td2,
                        'content' => $vardefvalue->def_val,
                        'content_id' => $msi1->content_id,
                        ]);
                    }
                }
            // dd($membershipids);
        }
        //save of new formula starts here
        $formula = Formula::find($request->input('id'));
        $formula->formula = $request->input('newformula');
            if($formula->save()){
                $request->session()->flash('success', 'Formula has been Updated');
            }else{
                $request->session()->flash('error', 'Error in Formula Update');
            }
        //updating calculated values~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        // $cformula = Formula::where('formula_id','Grade School')->first();
        // $cmembership = GsMembership::whereIn('member_id', [$request->input('id')])->where('content_id', $request->input('cid'))->get();
        $membershipids = GsMembership::select('member_id', 'content_id')->groupBy('content_id')->where('formula_id', $request->input('ed_type'))->get();
        $formulareplaced = $formula->formula;
            foreach($membershipids as $msidx){
            $membership = GsMembership::whereIn('member_id', [$msidx->member_id])->where('content_id', $msidx->content_id)->get();
                foreach ($membership as $pihsrebmem){
                $msfv = Variable::find($pihsrebmem->variable_id);
                $formulareplaced = str_replace($msfv->code,$pihsrebmem->content,$formulareplaced);
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
        $cCompute = Compute::whereIn('member_id', [$msidx->member_id])->where('content_id', $msidx->content_id)->update(['gtr' => $computedgtr,'amf' => $amfs]);
            //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    }
        return back();
        break;
    case "High School":
 $hsmembership = HsMembership::select('variable_id')->whereIn('formula_id', [$request->input('ed_type')])->get();
        $newarra = array();
            foreach ($hsmembership as $membershipx) {
                if(!in_array($membershipx->variable_id, $newarra, true)){
                array_push($newarra, $membershipx->variable_id);
                }
            }
        $newvari = $request->input('newvari');
        $exvari = explode(" ", $newvari);
        $thedifference = array_diff($newarra, $exvari);       
        $thedifference2 = array_diff($exvari,$newarra); 
        if(!empty($thedifference)){
            HsMembership::whereIn('variable_id', $thedifference)->delete();
        }elseif(!empty($thedifference2)){
            $membershipids = HsMembership::select('member_id', 'content_id')->groupBy('content_id')->where('formula_id', $request->input('ed_type'))->get();
                foreach($membershipids as $msi1){ 
                    foreach($thedifference2 as $td2){ 
                    $vardefvalue = Variable::where('id',$td2)->first();
                    HsMembership::whereIn('variable_id', $thedifference2)->where('formula_id', $request->input('ed_type'))->create([
                        'member_id' => $msi1->member_id,
                        'formula_id' => $request->input('ed_type'),
                        'variable_id' => $td2,
                        'content' => $vardefvalue->def_val,
                        'content_id' => $msi1->content_id,
                        ]);
                    }
                }
        }
        $formula = Formula::find($request->input('id'));
        $formula->formula = $request->input('newformula');
            if($formula->save()){
                $request->session()->flash('success', 'Formula has been Updated');
            }else{
                $request->session()->flash('error', 'Error in Formula Update');
            }
        $membershipids = HsMembership::select('member_id', 'content_id')->groupBy('content_id')->where('formula_id', $request->input('ed_type'))->get();
        $formulareplaced = $formula->formula;
            foreach($membershipids as $msidx){
            $membership = HsMembership::whereIn('member_id', [$msidx->member_id])->where('content_id', $msidx->content_id)->get();
                foreach ($membership as $pihsrebmem){
                $msfv = Variable::find($pihsrebmem->variable_id);
                $formulareplaced = str_replace($msfv->code,$pihsrebmem->content,$formulareplaced);
                }   
            $computedgtr = eval("return $formulareplaced;");
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
                    if($deludehcs->gtrs <= $computedgtr && $deludehcs->gtre >= $computedgtr){
                        $amfs = $deludehcs->amf;
                    }
                }
        $cCompute = Compute::whereIn('member_id', [$msidx->member_id])->where('content_id', $msidx->content_id)->update(['gtr' => $computedgtr,'amf' => $amfs]);
    }

        return back();
        break;
    case "Basic Education":
 $bedmembership = BedMembership::select('variable_id')->whereIn('formula_id', [$request->input('ed_type')])->get();
        $newarra = array();
            foreach ($bedmembership as $membershipx) {
                if(!in_array($membershipx->variable_id, $newarra, true)){
                array_push($newarra, $membershipx->variable_id);
                }
            }
        $newvari = $request->input('newvari');
        $exvari = explode(" ", $newvari);
        $thedifference = array_diff($newarra, $exvari);       
        $thedifference2 = array_diff($exvari,$newarra); 
        if(!empty($thedifference)){
            BedMembership::whereIn('variable_id', $thedifference)->delete();
        }elseif(!empty($thedifference2)){
            $membershipids = BedMembership::select('member_id', 'content_id')->groupBy('content_id')->where('formula_id', $request->input('ed_type'))->get();
                foreach($membershipids as $msi1){ 
                    foreach($thedifference2 as $td2){ 
                    $vardefvalue = Variable::where('id',$td2)->first();
                    BedMembership::whereIn('variable_id', $thedifference2)->where('formula_id', $request->input('ed_type'))->create([
                        'member_id' => $msi1->member_id,
                        'formula_id' => $request->input('ed_type'),
                        'variable_id' => $td2,
                        'content' => $vardefvalue->def_val,
                        'content_id' => $msi1->content_id,
                        ]);
                    }
                }
        }
        $formula = Formula::find($request->input('id'));
        $formula->formula = $request->input('newformula');
            if($formula->save()){
                $request->session()->flash('success', 'Formula has been Updated');
            }else{
                $request->session()->flash('error', 'Error in Formula Update');
            }
        $membershipids = BedMembership::select('member_id', 'content_id')->groupBy('content_id')->where('formula_id', $request->input('ed_type'))->get();
        $formulareplaced = $formula->formula;
            foreach($membershipids as $msidx){
            $membership = BedMembership::whereIn('member_id', [$msidx->member_id])->where('content_id', $msidx->content_id)->get();
                foreach ($membership as $pihsrebmem){
                $msfv = Variable::find($pihsrebmem->variable_id);
                $formulareplaced = str_replace($msfv->code,$pihsrebmem->content,$formulareplaced);
                }   
            $computedgtr = eval("return $formulareplaced;");
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
                    if($deludehcs->gtrs <= $computedgtr && $deludehcs->gtre >= $computedgtr){
                        $amfs = $deludehcs->amf;
                    }
                }
        $cCompute = Compute::whereIn('member_id', [$msidx->member_id])->where('content_id', $msidx->content_id)->update(['gtr' => $computedgtr,'amf' => $amfs]);
    }

        return back();
        break; 
    case "College Semester":
    case "College Trimester": 
 $colmembership = ColMembership::select('variable_id')->whereIn('formula_id', [$request->input('ed_type')])->get();
        $newarra = array();
            foreach ($colmembership as $membershipx) {
                if(!in_array($membershipx->variable_id, $newarra, true)){
                array_push($newarra, $membershipx->variable_id);
                }
            }
        $newvari = $request->input('newvari');
        $exvari = explode(" ", $newvari);
        $thedifference = array_diff($newarra, $exvari);       
        $thedifference2 = array_diff($exvari,$newarra); 
        if(!empty($thedifference)){
            ColMembership::whereIn('variable_id', $thedifference)->delete();
        }elseif(!empty($thedifference2)){
            $membershipids = ColMembership::select('member_id', 'content_id')->groupBy('content_id')->where('formula_id', $request->input('ed_type'))->get();
                foreach($membershipids as $msi1){ 
                    foreach($thedifference2 as $td2){ 
                    $vardefvalue = Variable::where('id',$td2)->first();
                    ColMembership::whereIn('variable_id', $thedifference2)->where('formula_id', $request->input('ed_type'))->create([
                        'member_id' => $msi1->member_id,
                        'formula_id' => $request->input('ed_type'),
                        'variable_id' => $td2,
                        'content' => $vardefvalue->def_val,
                        'content_id' => $msi1->content_id,
                        ]);
                    }
                }
        }
        $formula = Formula::find($request->input('id'));
        $formula->formula = $request->input('newformula');
            if($formula->save()){
                $request->session()->flash('success', 'Formula has been Updated');
            }else{
                $request->session()->flash('error', 'Error in Formula Update');
            }
        $membershipids = ColMembership::select('member_id', 'content_id')->groupBy('content_id')->where('formula_id', $request->input('ed_type'))->get();
        $formulareplaced = $formula->formula;
            foreach($membershipids as $msidx){
            $membership = ColMembership::whereIn('member_id', [$msidx->member_id])->where('content_id', $msidx->content_id)->get();
                foreach ($membership as $pihsrebmem){
                $msfv = Variable::find($pihsrebmem->variable_id);
                $formulareplaced = str_replace($msfv->code,$pihsrebmem->content,$formulareplaced);
                }   
            $computedgtr = eval("return $formulareplaced;");
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
                    if($deludehcs->gtrs <= $computedgtr && $deludehcs->gtre >= $computedgtr){
                        $amfs = $deludehcs->amf;
                    }
                }
        $cCompute = Compute::whereIn('member_id', [$msidx->member_id])->where('content_id', $msidx->content_id)->update(['gtr' => $computedgtr,'amf' => $amfs]);
    }

        return back();
        break;
    case "Graduate Education Semester":
    case "Graduate Education Trimester":
 $gedmembership = GedMembership::select('variable_id')->whereIn('formula_id', [$request->input('ed_type')])->get();
        $newarra = array();
            foreach ($gedmembership as $membershipx) {
                if(!in_array($membershipx->variable_id, $newarra, true)){
                array_push($newarra, $membershipx->variable_id);
                }
            }
        $newvari = $request->input('newvari');
        $exvari = explode(" ", $newvari);
        $thedifference = array_diff($newarra, $exvari);       
        $thedifference2 = array_diff($exvari,$newarra); 
        if(!empty($thedifference)){
            GedMembership::whereIn('variable_id', $thedifference)->delete();
        }elseif(!empty($thedifference2)){
            $membershipids = GedMembership::select('member_id', 'content_id')->groupBy('content_id')->where('formula_id', $request->input('ed_type'))->get();
                foreach($membershipids as $msi1){ 
                    foreach($thedifference2 as $td2){ 
                    $vardefvalue = Variable::where('id',$td2)->first();
                    GedMembership::whereIn('variable_id', $thedifference2)->where('formula_id', $request->input('ed_type'))->create([
                        'member_id' => $msi1->member_id,
                        'formula_id' => $request->input('ed_type'),
                        'variable_id' => $td2,
                        'content' => $vardefvalue->def_val,
                        'content_id' => $msi1->content_id,
                        ]);
                    }
                }
        }
        $formula = Formula::find($request->input('id'));
        $formula->formula = $request->input('newformula');
            if($formula->save()){
                $request->session()->flash('success', 'Formula has been Updated');
            }else{
                $request->session()->flash('error', 'Error in Formula Update');
            }
        $membershipids = GedMembership::select('member_id', 'content_id')->groupBy('content_id')->where('formula_id', $request->input('ed_type'))->get();
        $formulareplaced = $formula->formula;
            foreach($membershipids as $msidx){
            $membership = GedMembership::whereIn('member_id', [$msidx->member_id])->where('content_id', $msidx->content_id)->get();
                foreach ($membership as $pihsrebmem){
                $msfv = Variable::find($pihsrebmem->variable_id);
                $formulareplaced = str_replace($msfv->code,$pihsrebmem->content,$formulareplaced);
                }   
            $computedgtr = eval("return $formulareplaced;");
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
                    if($deludehcs->gtrs <= $computedgtr && $deludehcs->gtre >= $computedgtr){
                        $amfs = $deludehcs->amf;
                    }
                }
        $cCompute = Compute::whereIn('member_id', [$msidx->member_id])->where('content_id', $msidx->content_id)->update(['gtr' => $computedgtr,'amf' => $amfs]);
    }

        return back();
        break;
    default:
}
    }






        public function updatevariable(Request $request)
    {
        $vari = new Variable();
        $vari->code = $request->input('newvariable');
        $vari->title = $request->input('newvartitle');
//----------------------------------------------------
        $vari->def_val = $request->input('newvarval');
//----------------------------------------------------
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
