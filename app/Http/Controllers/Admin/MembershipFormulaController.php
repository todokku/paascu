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
        $gs = DB::table('membership_formulas')->where('ed_level', 'gs')->first();
        $hs = DB::table('membership_formulas')->where('ed_level', 'hs')->first();
        $bed = DB::table('membership_formulas')->where('ed_level', 'bed')->first();
        $semcol = DB::table('membership_formulas')->where('ed_level', 'semcol')->first();
        $tricol = DB::table('membership_formulas')->where('ed_level', 'tricol')->first();
        $semged = DB::table('membership_formulas')->where('ed_level', 'semged')->first();
        $triged= DB::table('membership_formulas')->where('ed_level', 'triged')->first();
        return view('admin.membershipformula.index')
        ->with('gs', $gs)
        ->with('hs', $hs)
        ->with('bed', $bed)
        ->with('semcol', $semcol)
        ->with('tricol', $tricol)
        ->with('semged', $semged)
        ->with('triged', $triged);
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
    public function edit(MembershipFormula $membershipFormula)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MembershipFormula  $membershipFormula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MembershipFormula $membershipFormula)
    {
        //
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
