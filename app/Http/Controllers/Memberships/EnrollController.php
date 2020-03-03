<?php

namespace App\Http\Controllers\Memberships;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Members;
use App\AccreditedCollegeProgram;
use App\AccreditedGraduateProgram;
use App\GsMembership;
use App\HsMembership;
use App\BedMembership;
use App\MembershipFormula;
class EnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $acp = AccreditedCollegeProgram::all();
        $agp = AccreditedGraduateProgram::all();
        $members = Members::orderBy('school','asc')->get();
        $formula = MembershipFormula::where('ed_type','Grade School')->first(); 
        $gspieces = explode(" ", $formula->variable);
        return view('admin.membershipfee.enroll.index')->with('members', $members)->with('acp', $acp)->with('agp', $agp)->with('gspieces', $gspieces);
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
    public function storegs(Request $request){
        $formula = MembershipFormula::where('ed_type','Grade School')->first();
        $gspieces = explode(" ", $formula->variable);
        $i = 0;
        $formulareplaced = $formula->variable;
foreach ($gspieces as $seceipsg){
    if(strlen($seceipsg)>1){
        $gs = new GsMembership();
        $gs->member_id = $request->input('gsname');
        $gs->title = $seceipsg;
        $gs->content = $request->input($seceipsg);
        $gs->position = $i;
        //replacing to formula
foreach ($gspieces as $seceipsgx){
    if(strlen($seceipsgx)>1){
        $formulareplaced = str_replace($seceipsgx,$request->input($seceipsgx),$formulareplaced);
    }
}
        //calculate gtr
        $gs->gtr = eval("return $formulareplaced;");
        $gs->save();
        $i++;
    }
}
        $request->session()->flash('success', 'Grade School Membership has been Added');
        return redirect()->route('enrollmembership.index');
        }
    
        public function storehs(Request $request){

        $hs = new HsMembership();
        $hs->te = $request->input('hste');
        $hs->atf = $request->input('hsatf');
        $hs->member_id = $request->input('hsname');
        $hs->gtr = 404;
 
        if($hs->save()){

        $request->session()->flash('success', 'High School Membership has been Added');
        }else{
        $request->session()->flash('error', 'Error in High School Membership Registration');
        }
        return redirect()->route('enrollmembership.index');
  
    }

// public function storehs(Request $request){
//     $formula = MembershipFormula::where('ed_type','High School')->first();
//     $hspieces = explode(" ", $formula->variable);
//     $i = 0;
//     $formulareplaced = $formula->variable;
//         foreach ($hspieces as $seceipsh){
//             if(strlen($seceipsh)>1){
//             $hs = new HsMembership();
//             $hs->member_id = $request->input('hsname');
//             $hs->title = $seceipsh;
//             $hs->content = $request->input($seceipsh);
//             $hs->position = $i;
//         //replacing to formula
//         foreach ($hspieces as $seceipshx){
//             if(strlen($seceipshx)>1){
//             $formulareplaced = str_replace($seceipshx,$request->input($seceipshx),$formulareplaced);
//             }
//         }
//         //calculate gtr
//         $hs->gtr = eval("return $formulareplaced;");
//         $hs->save();
//         $i++;
//             }
//         }
//         return redirect()->route('enrollmembership.index');
//     }



    

        public function storebed(Request $request){

        $bed = new BedMembership();
        $gs = $request->input('bedgste');
        $hs = $request->input('bedhste');

        $bed->gste = $request->input('bedgste');
        $bed->hste = $request->input('bedhste');

        $bed->te = $gs*$hs; 
        $bed->atf = $request->input('bedatf');
        $bed->member_id = $request->input('bedname');
        $bed->gtr = 404;
 
        if($bed->save()){

        $request->session()->flash('success', 'High School Membership has been Added');
        }else{
        $request->session()->flash('error', 'Error in High School Membership Registration');
        }
        return redirect()->route('enrollmembership.index');
  
    }
}
