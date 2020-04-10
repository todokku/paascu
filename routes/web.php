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



	
 	Route::resource('/hsmembership','Memberships\HsMembershipController', ['except' =>['show', 'create', 'store']]);
	Route::get('/hsmembership','Memberships\HsMembershipController@index')->name('hsmembership.index');

	Route::resource('/bedmembership','Memberships\BedMembershipController', ['except' =>['show', 'create', 'store']]);
	Route::get('/bedmembership','Memberships\BedMembershipController@index')->name('bedmembership.index');


//revising the fucking enrollment
 	Route::get('/gsenrollment','MembershipEnrollment\GsEnrollController@index')->name('gsenrollment.index');
 	Route::post('/gsenrollment','MembershipEnrollment\GsEnrollController@store')->name('gsenrollment.store');
//hs enroll
 	Route::get('/hsenrollment','MembershipEnrollment\HsEnrollController@index')->name('hsenrollment.index');
 	Route::post('/hsenrollment','MembershipEnrollment\HsEnrollController@store')->name('hsenrollment.store');
//bed enroll
 	Route::get('/bedenrollment','MembershipEnrollment\BedEnrollController@index')->name('bedenrollment.index');
 	Route::post('/bedenrollment','MembershipEnrollment\BedEnrollController@store')->name('bedenrollment.store');

 //col enroll
 	Route::get('/colenrollment','MembershipEnrollment\ColEnrollController@index')->name('colenrollment.index');
 	// Route::post('/colenrollment','MembershipEnrollment\ColEnrollController@store')->name('colenrollment.store');
 	// Route::get('/colenrollment/semester/{id}','Memberships\ColEnrollController@semester')->name('colenrollment.semester');
 //col sem enroll
 	Route::post('/colsemenrollment/','MembershipEnrollment\ColsemEnrollController@index')->name('colsemenrollment.index');
 	Route::post('/colsemenrollment/submit','MembershipEnrollment\ColsemEnrollController@store')->name('colsemenrollment.store');
 //col tri enroll
 	Route::post('/coltrienrollment/','MembershipEnrollment\ColtriEnrollController@index')->name('coltrienrollment.index');
 	Route::post('/coltrienrollment/submit','MembershipEnrollment\ColtriEnrollController@store')->name('coltrienrollment.store');



 //ged enroll
 	Route::get('/gedenrollment','MembershipEnrollment\GedEnrollController@index')->name('gedenrollment.index');
 	// Route::post('/colenrollment','MembershipEnrollment\ColEnrollController@store')->name('colenrollment.store');
 	// Route::get('/colenrollment/semester/{id}','Memberships\ColEnrollController@semester')->name('colenrollment.semester');
 //ged sem enroll
 	Route::post('/gedsemenrollment/','MembershipEnrollment\GedsemEnrollController@index')->name('gedsemenrollment.index');
 	Route::post('/gedsemenrollment/submit','MembershipEnrollment\GedsemEnrollController@store')->name('gedsemenrollment.store');
 //ged tri enroll
 	Route::post('/gedtrienrollment/','MembershipEnrollment\GedtriEnrollController@index')->name('gedtrienrollment.index');
 	Route::post('/gedtrienrollment/submit','MembershipEnrollment\GedtriEnrollController@store')->name('gedtrienrollment.store');



//THIS IS THE MAANGE GS 
 	Route::resource('/gsmembership','Memberships\GsMembershipController', ['except' =>['show', 'create', 'store']]);
	Route::get('/gsmembership','Memberships\GsMembershipController@index')->name('gsmembership.index');
	// Route::get('/gsmembership/getformula','Memberships\GsMembershipController@formulagroup')->name('gsmembership.getformula');
 	Route::get('/gsenrollment/{id}/{content}/edit','Memberships\GsMembershipController@edit')->name('gsenrollment.edit');
 	Route::post('/gsenrollment/update','Memberships\GsMembershipController@update')->name('gsenrollment.update');

//THIS IS THE MAANGE HS 
 	Route::resource('/hsmembership','Memberships\HsMembershipController', ['except' =>['show', 'create', 'store']]);
	Route::get('/hsmembership','Memberships\HsMembershipController@index')->name('hsmembership.index');
	// Route::get('/hsmembership/getformula','Memberships\HsMembershipController@formulagroup')->name('hsmembership.getformula');
 	Route::get('/hsenrollment/{id}/edit','Memberships\HsMembershipController@edit')->name('hsenrollment.edit');
 	Route::post('/hsenrollment/update','Memberships\HsMembershipController@update')->name('hsenrollment.update');

//THIS IS THE MAANGE BED 
 	Route::resource('/bedmembership','Memberships\BedMembershipController', ['except' =>['show', 'create', 'store']]);
	Route::get('/bedmembership','Memberships\BedMembershipController@index')->name('bedmembership.index');
	// Route::get('/bedmembership/getformula','Memberships\BedMembershipController@formulagroup')->name('bedmembership.getformula');
 	Route::get('/bedenrollment/{id}/edit','Memberships\BedMembershipController@edit')->name('bedenrollment.edit');
 	Route::post('/bedenrollment/update','Memberships\BedMembershipController@update')->name('bedenrollment.update');

//THIS IS THE MAANGE COL SEM
 	Route::resource('/colsemmembership','Memberships\ColsemMembershipController', ['except' =>['show', 'create', 'store']]);
	Route::get('/colsemmembership','Memberships\ColsemMembershipController@index')->name('colsemmembership.index');
	// Route::get('/bedmembership/getformula','Memberships\BedMembershipController@formulagroup')->name('bedmembership.getformula');
 	Route::get('/colsemenrollment/{id}/edit','Memberships\ColsemMembershipController@edit')->name('colsemenrollment.edit');
 	Route::post('/colsemenrollment/update','Memberships\ColsemMembershipController@update')->name('colsemenrollment.update');

//THIS IS THE MAANGE COL TRI
 	Route::resource('/coltrimembership','Memberships\ColtriMembershipController', ['except' =>['show', 'create', 'store']]);
	Route::get('/coltrimembership','Memberships\ColtriMembershipController@index')->name('coltrimembership.index');
	// Route::get('/bedmembership/getformula','Memberships\BedMembershipController@formulagroup')->name('bedmembership.getformula');
 	Route::get('/coltrienrollment/{id}/edit','Memberships\ColtriMembershipController@edit')->name('coltrienrollment.edit');
 	Route::post('/coltrienrollment/update','Memberships\ColtriMembershipController@update')->name('coltrienrollment.update');




//THIS IS THE MAANGE GED SEM
 	Route::resource('/gedsemmembership','Memberships\GedsemMembershipController', ['except' =>['show', 'create', 'store']]);
	Route::get('/gedsemmembership','Memberships\GedsemMembershipController@index')->name('gedsemmembership.index');
	// Route::get('/bedmembership/getformula','Memberships\BedMembershipController@formulagroup')->name('bedmembership.getformula');
 	Route::get('/gedsemenrollment/{id}/edit','Memberships\GedsemMembershipController@edit')->name('gedsemenrollment.edit');
 	Route::post('/gedsemenrollment/update','Memberships\GedsemMembershipController@update')->name('gedsemenrollment.update');

//THIS IS THE MAANGE GED TRI
 	Route::resource('/gedtrimembership','Memberships\GedtriMembershipController', ['except' =>['show', 'create', 'store']]);
	Route::get('/gedtrimembership','Memberships\GedtriMembershipController@index')->name('gedtrimembership.index');
	// Route::get('/bedmembership/getformula','Memberships\BedMembershipController@formulagroup')->name('bedmembership.getformula');
 	Route::get('/gedtrienrollment/{id}/edit','Memberships\GedtriMembershipController@edit')->name('gedtrienrollment.edit');
 	Route::post('/gedtrienrollment/update','Memberships\GedtriMembershipController@update')->name('gedtrienrollment.update');

//BILLING
Route::resource('/billing','BillingController', ['except' =>['show', 'create', 'store']]);
Route::get('/billing', 'BillingController@index')->name('billing.index');

Route::get('/billing/{ids}/{idc}/{mscid}/pdf','BillingController@export_pdf')->name('billing.pdf');

Route::get('/billing/{ids}/{idc}/{mscid}/pdf/download','BillingController@download_pdf')->name('download.pdf');
