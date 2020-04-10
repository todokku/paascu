<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Compute;
use App\Members;
use App\Formula;
use App\Variable;
use App\GsMembership;
use App\HsMembership;
use App\BedMembership;
use App\ColMembership;
use App\GedMembership;
class BillingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compute = Compute::all();
        return view('admin.billing.index')->with('compute', $compute);
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

      public function export_pdf($ids, $idc, $mscid)
  {
    $school = Members::find($ids);
    $schoolname = $school->school;
    $fulladdress = $school->address;
    $address = str_replace(",","\n",$fulladdress);
    $compute = Compute::find($idc);
    $date = date("m/d/Y");
    $time = strtotime("+1 year", time());
    $year = date("Y", $time);

    // if $idc "selected compute id" has "Grade School" then find it in gs_memberships table
    if(strcmp($compute->formula_id , "Grade School") == 0){ 
    //gets all the ids *contains multiple* into one for variable names
    $membershipids = GsMembership::select('variable_id')->groupBy('variable_id')->get();

    $membershipformula = Formula::where('formula_id','Grade School')->first();
    $replacedformula = $membershipformula->formula;
    $membershipvariables = Variable::whereIn('ed_type',['Grade School'])->get();
    foreach ($membershipvariables as $mv){
    $replacedformula =   str_replace($mv->code,$mv->title,$replacedformula);
    }
//------------------------------------
$membership = GsMembership::whereIn('member_id', [$ids])->where('content_id', $mscid)->get();
//------------------------------------
    $data = [
        'id' => $compute->id,
        'date' => $date, 
        'school' => $schoolname,
        'address' => $address,
        'membership_type' => $compute->formula_id,
        'member' => $school,
//------------------------------------
        'membertype' => $membership,
//------------------------------------
        'membershipids' => $membershipids,
        'gtr' => number_format($compute->gtr,2),
        'amf' => number_format($compute->amf,2),
        'addyear' => $year,
        'formula' => $replacedformula,
        'boxes' => $membershipvariables,
    ];
    }
    elseif(strcmp($compute->formula_id , "High School") == 0){
    $membershipids = HsMembership::select('variable_id')->groupBy('variable_id')->get();
    $membershipformula = Formula::where('formula_id','Grade School')->first();
    $replacedformula = $membershipformula->formula;
    $membershipvariables = Variable::whereIn('ed_type',['Grade School'])->get();
    foreach ($membershipvariables as $mv){
    $replacedformula =   str_replace($mv->code,$mv->title,$replacedformula);
    }

$membership = HsMembership::whereIn('member_id', [$ids])->where('content_id', $mscid)->get();
    $data = [
        'id' => $compute->id,
        'date' => $date, 
        'school' => $schoolname,
        'address' => $address,
        'membership_type' => $compute->formula_id,
        'member' => $school,
        'membertype' =>  $membership,
        'membershipids' => $membershipids,
        'gtr' => number_format($compute->gtr,2),
        'amf' => number_format($compute->amf,2),
        'addyear' => $year,
        'formula' => $replacedformula,
        'boxes' => $membershipvariables,
    ];
    }
    elseif(strcmp($compute->formula_id , "Basic Education") == 0){
    $membershipids = BedMembership::select('variable_id')->groupBy('variable_id')->get();
    $membershipformula = Formula::where('formula_id','Basic Education')->first();
    $replacedformula = $membershipformula->formula;
    $membershipvariables = Variable::whereIn('ed_type',['Basic Education'])->get();
    foreach ($membershipvariables as $mv){
    $replacedformula =   str_replace($mv->code,$mv->title,$replacedformula);
    }

$membership = BedMembership::whereIn('member_id', [$ids])->where('content_id', $mscid)->get();
    $data = [
        'id' => $compute->id,
        'date' => $date, 
        'school' => $schoolname,
        'address' => $address,
        'membership_type' => $compute->formula_id,
        'member' => $school,
        'membertype' => $membership,
        'membershipids' => $membershipids,
        'gtr' => number_format($compute->gtr,2),
        'amf' => number_format($compute->amf,2),
        'addyear' => $year,
        'formula' => $replacedformula,
        'boxes' => $membershipvariables,
    ];
    }
    elseif(strcmp($compute->formula_id , "College Semester") == 0){
    $membershipids = ColMembership::select('variable_id')->groupBy('variable_id')->where('formula_id', 'College Semester')->get();
    $membershipformula = Formula::where('formula_id','College Semester')->first();
    $replacedformula = $membershipformula->formula;
    $membershipvariables = Variable::whereIn('ed_type',['College Semester'])->get();
    foreach ($membershipvariables as $mv){
    $replacedformula =   str_replace($mv->code,$mv->title,$replacedformula);
    }
    $data = [
        'id' => $compute->id,
        'date' => $date, 
        'school' => $schoolname,
        'address' => $address,
        'membership_type' => $compute->formula_id,
        'member' => $school,
        'membertype' => $school->colmembership,
        'membershipids' => $membershipids,
        'gtr' => number_format($compute->gtr,2),
        'amf' => number_format($compute->amf,2),
        'addyear' => $year,
        'formula' => $replacedformula,
        'boxes' => $membershipvariables,
    ];
    }
    elseif(strcmp($compute->formula_id , "College Trimester") == 0){
    $membershipids = ColMembership::select('variable_id')->groupBy('variable_id')->where('formula_id', 'College Trimester')->get();
    $membershipformula = Formula::where('formula_id','College Trimester')->first();
    $replacedformula = $membershipformula->formula;
    $membershipvariables = Variable::whereIn('ed_type',['College Trimester'])->get();
    foreach ($membershipvariables as $mv){
    $replacedformula =   str_replace($mv->code,$mv->title,$replacedformula);
    }
    $data = [
        'id' => $compute->id,
        'date' => $date, 
        'school' => $schoolname,
        'address' => $address,
        'membership_type' => $compute->formula_id,
        'member' => $school,
        'membertype' => $school->colmembership,
        'membershipids' => $membershipids,
        'gtr' => number_format($compute->gtr,2),
        'amf' => number_format($compute->amf,2),
        'addyear' => $year,
        'formula' => $replacedformula,
        'boxes' => $membershipvariables,
    ];
    }
    elseif(strcmp($compute->formula_id , "Graduate Education Semester") == 0){
    $membershipids = GedMembership::select('variable_id')->groupBy('variable_id')->where('formula_id', 'Graduate Education Semester')->get();
    $membershipformula = Formula::where('formula_id','Graduate Education Semester')->first();
    $replacedformula = $membershipformula->formula;
    $membershipvariables = Variable::whereIn('ed_type',['Graduate Education Semester'])->get();
    foreach ($membershipvariables as $mv){
    $replacedformula =   str_replace($mv->code,$mv->title,$replacedformula);
    }
    $data = [
        'id' => $compute->id,
        'date' => $date, 
        'school' => $schoolname,
        'address' => $address,
        'membership_type' => $compute->formula_id,
        'member' => $school,
        'membertype' => $school->gedmembership,
        'membershipids' => $membershipids,
        'gtr' => number_format($compute->gtr,2),
        'amf' => number_format($compute->amf,2),
        'addyear' => $year,
        'formula' => $replacedformula,
        'boxes' => $membershipvariables,
    ];
    }
    elseif(strcmp($compute->formula_id , "Graduate Education Trimester") == 0){
    $membershipids = GedMembership::select('variable_id')->groupBy('variable_id')->where('formula_id', 'Graduate Education Trimester')->get();
    $membershipformula = Formula::where('formula_id','Graduate Education Trimester')->first();
    $replacedformula = $membershipformula->formula;
    $membershipvariables = Variable::whereIn('ed_type',['Graduate Education Trimester'])->get();
    foreach ($membershipvariables as $mv){
    $replacedformula =   str_replace($mv->code,$mv->title,$replacedformula);
    }
    $data = [
        'id' => $compute->id,
        'date' => $date, 
        'school' => $schoolname,
        'address' => $address,
        'membership_type' => $compute->formula_id,
        'member' => $school,
        'membertype' => $school->gedmembership,
        'membershipids' => $membershipids,
        'gtr' => number_format($compute->gtr,2),
        'amf' => number_format($compute->amf,2),
        'addyear' => $year,
        'formula' => $replacedformula,
        'boxes' => $membershipvariables,
    ];
    }
    // Send data to the view using loadView function of PDF facade
    $pdf = \PDF::loadView('admin.billing.pdf', $data);
    // If you want to store the generated pdf to the server then you can use the store function
    // $pdf->save(storage_path().'_filename.pdf');
    // Finally, you can download the file using download function
    // return $pdf->download('customers.pdf');
    return $pdf->stream($schoolname.' '.$date.'.pdf');
  }













      public function download_pdf($ids, $idc, $mscid)
  {
    $school = Members::find($ids);
    $schoolname = $school->school;
    $fulladdress = $school->address;
    $address = str_replace(",","\n",$fulladdress);
    $compute = Compute::find($idc);
    $date = date("m/d/Y");
    $time = strtotime("+1 year", time());
    $year = date("Y", $time);

    // if $idc "selected compute id" has "Grade School" then find it in gs_memberships table
    if(strcmp($compute->formula_id , "Grade School") == 0){ 
    //gets all the ids *contains multiple* into one for variable names
    $membershipids = GsMembership::select('variable_id')->groupBy('variable_id')->get();

    $membershipformula = Formula::where('formula_id','Grade School')->first();
    $replacedformula = $membershipformula->formula;
    $membershipvariables = Variable::whereIn('ed_type',['Grade School'])->get();
    foreach ($membershipvariables as $mv){
    $replacedformula =   str_replace($mv->code,$mv->title,$replacedformula);
    }
//------------------------------------
$membership = GsMembership::whereIn('member_id', [$ids])->where('content_id', $mscid)->get();
//------------------------------------
    $data = [
        'id' => $compute->id,
        'date' => $date, 
        'school' => $schoolname,
        'address' => $address,
        'membership_type' => $compute->formula_id,
        'member' => $school,
//------------------------------------
        'membertype' => $membership,
//------------------------------------
        'membershipids' => $membershipids,
        'gtr' => number_format($compute->gtr,2),
        'amf' => number_format($compute->amf,2),
        'addyear' => $year,
        'formula' => $replacedformula,
        'boxes' => $membershipvariables,
    ];
    }
    elseif(strcmp($compute->formula_id , "High School") == 0){
    $membershipids = HsMembership::select('variable_id')->groupBy('variable_id')->get();
    $membershipformula = Formula::where('formula_id','Grade School')->first();
    $replacedformula = $membershipformula->formula;
    $membershipvariables = Variable::whereIn('ed_type',['Grade School'])->get();
    foreach ($membershipvariables as $mv){
    $replacedformula =   str_replace($mv->code,$mv->title,$replacedformula);
    }

$membership = HsMembership::whereIn('member_id', [$ids])->where('content_id', $mscid)->get();
    $data = [
        'id' => $compute->id,
        'date' => $date, 
        'school' => $schoolname,
        'address' => $address,
        'membership_type' => $compute->formula_id,
        'member' => $school,
        'membertype' =>  $membership,
        'membershipids' => $membershipids,
        'gtr' => number_format($compute->gtr,2),
        'amf' => number_format($compute->amf,2),
        'addyear' => $year,
        'formula' => $replacedformula,
        'boxes' => $membershipvariables,
    ];
    }
    elseif(strcmp($compute->formula_id , "Basic Education") == 0){
    $membershipids = BedMembership::select('variable_id')->groupBy('variable_id')->get();
    $membershipformula = Formula::where('formula_id','Basic Education')->first();
    $replacedformula = $membershipformula->formula;
    $membershipvariables = Variable::whereIn('ed_type',['Basic Education'])->get();
    foreach ($membershipvariables as $mv){
    $replacedformula =   str_replace($mv->code,$mv->title,$replacedformula);
    }

$membership = BedMembership::whereIn('member_id', [$ids])->where('content_id', $mscid)->get();
    $data = [
        'id' => $compute->id,
        'date' => $date, 
        'school' => $schoolname,
        'address' => $address,
        'membership_type' => $compute->formula_id,
        'member' => $school,
        'membertype' => $membership,
        'membershipids' => $membershipids,
        'gtr' => number_format($compute->gtr,2),
        'amf' => number_format($compute->amf,2),
        'addyear' => $year,
        'formula' => $replacedformula,
        'boxes' => $membershipvariables,
    ];
    }
    elseif(strcmp($compute->formula_id , "College Semester") == 0){
    $membershipids = ColMembership::select('variable_id')->groupBy('variable_id')->where('formula_id', 'College Semester')->get();
    $membershipformula = Formula::where('formula_id','College Semester')->first();
    $replacedformula = $membershipformula->formula;
    $membershipvariables = Variable::whereIn('ed_type',['College Semester'])->get();
    foreach ($membershipvariables as $mv){
    $replacedformula =   str_replace($mv->code,$mv->title,$replacedformula);
    }
    $data = [
        'id' => $compute->id,
        'date' => $date, 
        'school' => $schoolname,
        'address' => $address,
        'membership_type' => $compute->formula_id,
        'member' => $school,
        'membertype' => $school->colmembership,
        'membershipids' => $membershipids,
        'gtr' => number_format($compute->gtr,2),
        'amf' => number_format($compute->amf,2),
        'addyear' => $year,
        'formula' => $replacedformula,
        'boxes' => $membershipvariables,
    ];
    }
    elseif(strcmp($compute->formula_id , "College Trimester") == 0){
    $membershipids = ColMembership::select('variable_id')->groupBy('variable_id')->where('formula_id', 'College Trimester')->get();
    $membershipformula = Formula::where('formula_id','College Trimester')->first();
    $replacedformula = $membershipformula->formula;
    $membershipvariables = Variable::whereIn('ed_type',['College Trimester'])->get();
    foreach ($membershipvariables as $mv){
    $replacedformula =   str_replace($mv->code,$mv->title,$replacedformula);
    }
    $data = [
        'id' => $compute->id,
        'date' => $date, 
        'school' => $schoolname,
        'address' => $address,
        'membership_type' => $compute->formula_id,
        'member' => $school,
        'membertype' => $school->colmembership,
        'membershipids' => $membershipids,
        'gtr' => number_format($compute->gtr,2),
        'amf' => number_format($compute->amf,2),
        'addyear' => $year,
        'formula' => $replacedformula,
        'boxes' => $membershipvariables,
    ];
    }
    elseif(strcmp($compute->formula_id , "Graduate Education Semester") == 0){
    $membershipids = GedMembership::select('variable_id')->groupBy('variable_id')->where('formula_id', 'Graduate Education Semester')->get();
    $membershipformula = Formula::where('formula_id','Graduate Education Semester')->first();
    $replacedformula = $membershipformula->formula;
    $membershipvariables = Variable::whereIn('ed_type',['Graduate Education Semester'])->get();
    foreach ($membershipvariables as $mv){
    $replacedformula =   str_replace($mv->code,$mv->title,$replacedformula);
    }
    $data = [
        'id' => $compute->id,
        'date' => $date, 
        'school' => $schoolname,
        'address' => $address,
        'membership_type' => $compute->formula_id,
        'member' => $school,
        'membertype' => $school->gedmembership,
        'membershipids' => $membershipids,
        'gtr' => number_format($compute->gtr,2),
        'amf' => number_format($compute->amf,2),
        'addyear' => $year,
        'formula' => $replacedformula,
        'boxes' => $membershipvariables,
    ];
    }
    elseif(strcmp($compute->formula_id , "Graduate Education Trimester") == 0){
    $membershipids = GedMembership::select('variable_id')->groupBy('variable_id')->where('formula_id', 'Graduate Education Trimester')->get();
    $membershipformula = Formula::where('formula_id','Graduate Education Trimester')->first();
    $replacedformula = $membershipformula->formula;
    $membershipvariables = Variable::whereIn('ed_type',['Graduate Education Trimester'])->get();
    foreach ($membershipvariables as $mv){
    $replacedformula =   str_replace($mv->code,$mv->title,$replacedformula);
    }
    $data = [
        'id' => $compute->id,
        'date' => $date, 
        'school' => $schoolname,
        'address' => $address,
        'membership_type' => $compute->formula_id,
        'member' => $school,
        'membertype' => $school->gedmembership,
        'membershipids' => $membershipids,
        'gtr' => number_format($compute->gtr,2),
        'amf' => number_format($compute->amf,2),
        'addyear' => $year,
        'formula' => $replacedformula,
        'boxes' => $membershipvariables,
    ];
    }
    // Send data to the view using loadView function of PDF facade
    $pdf = \PDF::loadView('admin.billing.pdf', $data);
    // If you want to store the generated pdf to the server then you can use the store function
    $pdf->save(public_path().'\\pdf\\'.time().'.pdf');
    // Finally, you can download the file using download function
    return $pdf->download($schoolname.' '.$date.'.pdf');
    // return $pdf->stream($schoolname.' '.$date.'.pdf');
  }




}
