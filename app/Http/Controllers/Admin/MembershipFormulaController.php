<?php

namespace App\Http\Controllers\Admin;

use App\MembershipFormula;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class MembershipFormulaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // $gsfullformula = "";
        $formula = MembershipFormula::all();
        // ->orderBy('position','asc')->get();

        // foreach ($gsformula as $formulas) {
        //     $gsfullformula .= $formulas->variable." ";
        // }
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
    public function edit($id)
    {
        $formula = MembershipFormula::find($id);
        return view('admin.membershipformula.edit')->with('formula',$formula);
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
        $formula = MembershipFormula::find($request->input('id'));
        $formula->variable = $request->input('formula');
        if($formula->save()){
        $request->session()->flash('success', 'Member has been Updated');
        }else{
        $request->session()->flash('error', 'Error in Member Update');
        }
        return redirect()->route('admin.membershipformula.index');
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
