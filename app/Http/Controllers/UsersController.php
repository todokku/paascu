<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Gate;

class UsersController extends Controller
{

    public function __construct(){ 

        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
   




        return view('main.users.index')->with('users', $users);
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

if(Gate::denies('admin-user')){
    return redirect(route('users.index'));
}

        $roles = Role::all();

        return view('main.users.edit')->with([
            'user' => $user, 
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = $request->status;
        
        if($user->save()){

        $request->session()->flash('success', 'User has been Updated');
        }else{
        $request->session()->flash('error', 'Error in User Update');
        }
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
//     public function destroy(User $user)
//     {
//         if(Gate::denies('admin-user')){
//     return redirect(route('admin.users.index'));
// }
//         $user->roles()->detach();
//         $user->delete();

//         return redirect()->route('admin.users.index');
//     }

        public function destroyx(Request $request, $user)
    {
        $users = $request->name = $user;
        $users = User::find($users);
        $users->roles()->detach();
        $users->delete();

        return redirect()->route('users.index');
    }

}
