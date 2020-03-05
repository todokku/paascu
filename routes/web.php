<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	if(Gate::allows('admin-user')){
    return redirect(route('home'));
}else{
    return view('auth.login');
}
});

// Auth::routes(['verify' => true]);
Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/register', 'HomeController@index')->name('home');	

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:admin-user')->group(function(){
	//hide routes ? idk
	Route::resource('/users','UsersController', ['except' =>['show', 'create', 'store']]);
	Route::resource('/members','MembersController', ['except' =>['show', 'create', 'store']]);
	Route::resource('/programs','ProgramsController', ['except' =>['show', 'create', 'store']]);
	Route::resource('/schedulemembership','ScheduleMembershipController', ['except' =>['show', 'create', 'store']]);
 	// Route::resource('/membershipformula','MembershipFormulaController', ['except' =>['show', 'create', 'store']]);
 	Route::resource('/membershipformula','MembershipFormulaController', ['except' =>['show', 'create', 'store']]);

 	// Route::post('/membershipformula/update/{id}', 'MembershipFormulaController@update');
 	Route::get('/membershipformula/{id}/edit/{ed_type}','MembershipFormulaController@edit')->name('membershipformula.edit');
	Route::post('/membershipformula/update','MembershipFormulaController@update')->name('membershipformula.update');
	Route::post('/membershipformula/updatevariable','MembershipFormulaController@updatevariable')->name('membershipformula.updatevariable');
	
	Route::get('/members/{id}/edit','MembersController@edit')->name('members.edit');
	Route::post('/members/update','MembersController@update')->name('members.update');
	Route::get('/members/{id}/delete','MembersController@destroy')->name('members.destroy');
	Route::get('/members/create','MembersController@create')->name('members.create');
	Route::post('/members/create','MembersController@store')->name('members.store');

	//programs CRUD
	Route::get('/programs/{id}/edit','ProgramsController@edit')->name('programs.edit');
	Route::post('/programs/update','ProgramsController@update')->name('programs.update');
	Route::get('/programs/{id}/delete','ProgramsController@destroy')->name('programs.destroy');
	Route::get('/programs/create','ProgramsController@create')->name('programs.create');
	Route::post('/programs/create','ProgramsController@store')->name('programs.store');

	//schedulemembership CRUD
	Route::get('/schedulemembership/create','ScheduleMembershipController@create')->name('schedulemembership.create');
	Route::post('/schedulemembership/create','ScheduleMembershipController@store')->name('schedulemembership.store');
	Route::get('/schedulemembership/{id}/edit','ScheduleMembershipController@edit')->name('schedulemembership.edit');
	Route::post('/schedulemembership/update','ScheduleMembershipController@update')->name('schedulemembership.update');
	Route::get('/schedulemembership/{id}/delete','ScheduleMembershipController@destroy')->name('schedulemembership.destroy');

	//membership CRUD
	// Route::get('/membership','MembershipController@bed')->name('membership.bed.index');

	//membership formula CRUD
	// Route::get('/membershipformula/gshs','MembershipFormulaController@gshsformula')->name('membershipformula.gshsformula');


});		

	
 	Route::get('/enrollmembership','Memberships\EnrollController@index')->name('enrollmembership.index');
	Route::resource('/enrollmembership','Memberships\EnrollController', ['except' =>['show', 'create', 'store']]);
	Route::post('/enrollmembership/gs','Memberships\EnrollController@storegs')->name('enrollmembership.gs');
	Route::post('/enrollmembership/hs','Memberships\EnrollController@storehs')->name('enrollmembership.hs');
	Route::post('/enrollmembership/bed','Memberships\EnrollController@storebed')->name('enrollmembership.bed');


 	Route::resource('/gsmembership','Memberships\GsMembershipController', ['except' =>['show', 'create', 'store']]);
	Route::get('/gsmembership','Memberships\GsMembershipController@index')->name('gsmembership.index');
	Route::get('/gsmembership/getformula','Memberships\GsMembershipController@formulagroup')->name('gsmembership.getformula');
	
 	Route::resource('/hsmembership','Memberships\HsMembershipController', ['except' =>['show', 'create', 'store']]);
	Route::get('/hsmembership','Memberships\HsMembershipController@index')->name('hsmembership.index');

	Route::resource('/bedmembership','Memberships\BedMembershipController', ['except' =>['show', 'create', 'store']]);
	Route::get('/bedmembership','Memberships\BedMembershipController@index')->name('bedmembership.index');




//revising the fucking enrollment
 	Route::get('/gsenrollment','MembershipEnrollment\GsEnrollController@index')->name('gsenrollment.index');
