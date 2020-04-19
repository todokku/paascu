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
use App\AccreditedGraduateProgram;

class GedEnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Members::select('id','school')->whereHas('programs', function ($query) {
        $query->whereIn('ed_level', ['Graduate Education']);
        })->get();

        $agp = AccreditedGraduateProgram::all();

        return view('main.membershipenroll.ged.index')->with('members',$members)->with('agp',$agp);
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
        function fetch(Request $request)
{
     $select = $request->get('select');//ID OF FORM?
     $value = $request->get('value');//VALUE OF dropdown ID
     $dependent = $request->get('dependent');//next id of FORM depended on

     $data = Programs::whereIn('member_id', [$value])->where('ed_level', 'Graduate Education')->get();
     $output = "";
     foreach($data as $row)
     {
      $output .= '<option value="'.$row->id.'">'.$row->$dependent.'</option>';
     }
     echo $output;
    }
}
