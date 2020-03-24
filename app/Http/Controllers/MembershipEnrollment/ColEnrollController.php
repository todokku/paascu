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
use App\ScheduleMembership;
use App\AccreditedCollegeProgram;

class ColEnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Members::select('id','school')->whereHas('programs', function ($query) {
        $query->whereIn('ed_level', ['College']);
        })->get();

        // $acp = AccreditedCollegeProgram::all();

        // $formula = Formula::where('formula_id','College Semester')->first();
        // $colsempieces = explode(" ", $formula->formula);
        // $variabled = Variable::whereIn('code',$colsempieces)->where('ed_type', 'College Semester')->get();

        return view('admin.membershipenroll.col.index')->with('members',$members);
        // ->with('formula',$formula)->with('colsempieces',$colsempieces)->with('variabled',$variabled)->with('acp',$acp);
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

    // public function semester($id){
    //     $members = Members::select('id','school')->whereHas('programs', function ($query) {
    //     $query->whereIn('ed_level', ['College']);
    //     })->get();

    //     $acp = AccreditedCollegeProgram::all();

    //     $formula = Formula::where('formula_id','College Semester')->first();
    //     $colsempieces = explode(" ", $formula->formula);
    //     $variabled = Variable::whereIn('code',$colsempieces)->where('ed_type', 'College Semester')->get();

    //     return view('admin.membershipenroll.colsem.index')->with('members',$members)->with('formula',$formula)->with('colsempieces',$colsempieces)->with('variabled',$variabled)->with('acp',$acp);
    // }
}
