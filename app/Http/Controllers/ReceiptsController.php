<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Compute;
use App\Members;
use App\EnrolledProgram;
use App\Programs;
class ReceiptsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compute = Compute::all();
        return view('main.receipts.index')->with('compute',$compute);
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
    public function edit($id, $idc, $msid)
    {// $id = member_id, $idc = compute_id , $msid = content_id
        $whattype = Compute::find($idc);
        if($whattype->formula_id == "College Semester" || $whattype->formula_id == "College Trimester" || $whattype->formula_id == "Graduate Education Semester" || $whattype->formula_id == "Graduate Education Trimester"){
            $member = Members::find($id); //member->program
            $compute = Compute::find($idc); //verification
            $enrolled = EnrolledProgram::whereIn('compute_id',[$idc])->get();//programs
            $progids = array();
            foreach($member->programs as $mp){
                foreach($enrolled as $ep){
                    if($mp->program == $ep->program){
                        array_push($progids, $mp->id );
                    }
                }
            }
            $progdata = Programs::whereIn('id',$progids)->get();//programs
            $idp = implode(",", $progids);



        }else if($whattype->formula_id == "Grade School"){
        $member = Members::find($id);
        $compute = Compute::find($idc);
        $progids = "";
        foreach($member->programs as $mp){
            if($mp->ed_level == "Grade School"){
                    $progids = $mp->id;
                }
            }
        $progdata = Programs::where('id',$progids)->get();
        $idp = $progids; 
        }else if($whattype->formula_id == "High School"){
        $member = Members::find($id);
        $compute = Compute::find($idc);
        $progids = "";
        foreach($member->programs as $mp){
            if($mp->ed_level == "High School"){
                    $progids = $mp->id;
                }
            }
        $progdata = Programs::where('id',$progids)->get();
        $idp = $progids;
        }else if($whattype->formula_id == "Basic Education"){
        $member = Members::find($id);
        $compute = Compute::find($idc);
        $progids = "";
        foreach($member->programs as $mp){
            if($mp->ed_level == "Basic Education"){
                    $progids = $mp->id;
                }
            }
        $progdata = Programs::where('id',$progids)->get();
        $idp = $progids;
        }else{

        }

        return view('main.receipts.verify')->with('member',$member)->with('compute',$compute)->with('progdata',$progdata)->with('idp',$idp)->with('idc',$idc);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   $progids = $request->input('idp');
        $compids = $request->input('idc');

        $compute = Compute::find($compids);
        if($compute->formula_id == "College Semester" || $compute->formula_id == "College Trimester" || $compute->formula_id == "Graduate Education Semester" || $compute->formula_id == "Graduate Education Trimester"){
        $compute->verified = 'verified';
        $compute->receipt = $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('receipt'), $imageName);
        $compute->save();

        $progex = explode(",", $progids);

        $program = Programs::whereIn('id',$progex)->get();
        foreach($program as $pg){
        $program = Programs::find($pg->id);
        $program->level = $request->input("f".$pg->id);
        $program->valid = $request->input("s".$pg->id);
        $program->save();
        } 
}else{
        $progids = $request->input('idp');
        $compids = $request->input('idc');


        $compute->verified = 'verified';
        $compute->receipt = $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('receipt'), $imageName);
        $compute->save();

        $program = Programs::find($progids);
        $program->level = $request->input("f".$progids);
        $program->valid = $request->input("s".$progids);
        $program->save();  
}
        $request->session()->flash('success', 'Reciept has been verified!');
        return redirect()->route('receipts.index');

        // dd($request->input("f"));
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
