<?php

namespace App\Http\Controllers\Memberships;

use App\GsMembership;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Members;
use App\MembershipFormula;
// use App\BedMembership;
use DB;
use App\ScheduleMembership;

use App\Membership;
use App\Variable;
class GsMembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $formula = MembershipFormula::where('ed_type','Grade School')->first();
        // $membership = GsMembership::select('id', 'member_id', 'title', 'content', 'position', 'gtr')->groupBy('member_id')->get();
        // $pieces = explode(" ", $formula->variable); 
        // $sm = ScheduleMembership::all();
        // return view('admin.membershipfee.gs.index')->with('membership', $membership)->with('formula', $formula)->with('pieces', $pieces)->with( 'sm' , $sm );

        $members = Members::select('id','school')->whereHas('programs', function ($query) {
        $query->whereIn('program', ['Grade School']);
        })->get();

        $membership = Membership::all();
        $variable = Variable::all();
        $membershipids = Membership::select('variable_id')->groupBy('variable_id')->where('formula_id', 'Grade School')->with('variables')->get();

        // dd($membershipids);
        return view('admin.membershipfee.gs.index')->with('members',$members)->with('membership',$membership)->with('membershipids',$membershipids);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
     * @param  \App\Gshsmembership  $gshsmembership
     * @return \Illuminate\Http\Response
     */
    public function show(GsMembership $gsmembership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gshsmembership  $gshsmembership
     * @return \Illuminate\Http\Response
     */
    public function edit(GsMembership $gsmembership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gshsmembership  $gshsmembership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GsMembership $gsmembership)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gshsmembership  $gshsmembership
     * @return \Illuminate\Http\Response
     */
    public function destroy(GsMembership $gsmembership)
    {
        //
    }

    public function formulagroup(Request $request)
    {
        $id= $request->id;
        $data = DB::table('gs_memberships')->whereIn('member_id', [$id])->get();
        echo json_encode($data);

    }
}
