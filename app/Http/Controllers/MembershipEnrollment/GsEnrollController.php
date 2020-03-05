<?php

namespace App\Http\Controllers\MembershipEnrollment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

use App\Members;
use App\Formula;
use App\Variable;
use App\Programs;
class GsEnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        // $variIDcollector = array();


        // $members = Members::orderBy('school','asc')->get();
        // $formula = Formula::select('formula')->where('formula_id','Grade School')->get();
        // $varis = Variable::select('id', 'code')->whereIn('ed_type',['Grade School'])->get();
        // $sksksk = json_decode($formula);
        // $sksksk2 = json_decode($varis);
        // $formulaexplode = explode(" ", $sksksk[0]->formula);

        // foreach($formulaexplode as $fex){
        //     if(strlen($fex)>1){
        //         foreach($varis as $sirav)
        //             if(strcmp($sirav->code, $fex) == 0){

        //                 array_push($variIDcollector,$sirav->id);
        //                 array_push($variIDcollector,$sirav->code);
        //             }
        //         }
        //     }
        // dd($formula);
        // $comment = App\Post::find(1)->comments()->where('title', 'foo')->first();
        // $members = Members::all();
        // $Products = Members::has('programs')->whereIn('program', ['Grade School'])->get();
        $members = Members::select('id','school')->whereHas('programs', function ($query) {
        $query->whereIn('program', ['Grade School']);
        })->get();

        $formula = Formula::where('formula_id','Grade School')->first();
        // if(isset($formula)){
        $gspieces = explode(" ", $formula->formula);
        $variabled = Variable::whereIn('code',$gspieces)->get();
                return view('admin.membershipenroll.gs.index')->with('members',$members)->with('formula',$formula)->with('gspieces',$gspieces)->with('variabled',$variabled);
        // }else{

        //     return view('admin.membershipenroll.gs.index')->with('members',$members); 
        // }

        // dd($variabled);
        // $mataisubet = $members->programs()->whereIn('program', ['Grade School'])->get();
        // $members = Members::orderBy('school','asc')->get();
        // dd($gspieces);


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
//         $formula = MembershipFormula::where('ed_type','Grade School')->first();
//         $gspieces = explode(" ", $formula->variable);
//         $i = 0;
//         $formulareplaced = $formula->variable;
// foreach ($gspieces as $seceipsg){
//     if(strlen($seceipsg)>1){
//         $gs = new GsMembership();
//         $gs->member_id = $request->input('gsname');
//         $gs->title = $seceipsg;
//         $gs->content = $request->input($seceipsg);
//         $gs->position = $i;
//         //replacing to formula
// foreach ($gspieces as $seceipsgx){
//     if(strlen($seceipsgx)>1){
//         $formulareplaced = str_replace($seceipsgx,$request->input($seceipsgx),$formulareplaced);
//     }
// }
//         //calculate gtr
//         $gs->gtr = eval("return $formulareplaced;");
//         $gs->save();
//         $i++;
//     }
// }
//         $request->session()->flash('success', 'Grade School Membership has been Added');
//         return redirect()->route('enrollmembership.index');
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
