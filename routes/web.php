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

Auth::routes();

Auth::routes(['verify' => true]);

//-- "Dashboard" -- admin && user
	Route::get('/home', 'HomeController@index')->name('home')->middleware('can:admin-user')->middleware('verified');

//-- "User Accounts" -- admin only
	Route::resource('/users','UsersController', ['except' =>['show', 'create', 'store']])->middleware('can:admin');
	Route::get('/users/delete/{id}','UsersController@destroyx')->name('user.destroyx')->middleware('can:admin');

//-- "Manage Members" -- admin only
	Route::resource('/members','MembersController', ['except' =>['show', 'create', 'store']])->middleware('can:admin');
	Route::get('/members/{id}/edit','MembersController@edit')->name('members.edit')->middleware('can:admin');
	Route::post('/members/update','MembersController@update')->name('members.update')->middleware('can:admin');
	Route::get('/members/{id}/delete','MembersController@destroy')->name('members.destroy')->middleware('can:admin');
	Route::get('/members/create','MembersController@create')->name('members.create')->middleware('can:admin');
	Route::post('/members/create','MembersController@store')->name('members.store')->middleware('can:admin');

//-- "Manage Programs" -- admin only
	Route::resource('/programs','ProgramsController', ['except' =>['show', 'create', 'store']])->middleware('can:admin');
	Route::get('/programs/{id}/edit','ProgramsController@edit')->name('programs.edit')->middleware('can:admin');
	Route::post('/programs/update','ProgramsController@update')->name('programs.update')->middleware('can:admin');
	Route::get('/programs/{id}/delete','ProgramsController@destroy')->name('programs.destroy')->middleware('can:admin');
	Route::get('/programs/create','ProgramsController@create')->name('programs.create')->middleware('can:admin');
	Route::post('/programs/create','ProgramsController@store')->name('programs.store')->middleware('can:admin');

//-- "Manage Schedule Membership" -- admin only
	Route::resource('/schedulemembership','ScheduleMembershipController', ['except' =>['show', 'create', 'store']])->middleware('can:admin');
	Route::get('/schedulemembership/create','ScheduleMembershipController@create')->name('schedulemembership.create')->middleware('can:admin');
	Route::post('/schedulemembership/create','ScheduleMembershipController@store')->name('schedulemembership.store')->middleware('can:admin');
	Route::get('/schedulemembership/{id}/edit','ScheduleMembershipController@edit')->name('schedulemembership.edit')->middleware('can:admin');
	Route::post('/schedulemembership/update','ScheduleMembershipController@update')->name('schedulemembership.update')->middleware('can:admin');
	Route::get('/schedulemembership/{id}/delete','ScheduleMembershipController@destroy')->name('schedulemembership.destroy')->middleware('can:admin');

//-- "Manage Membership Formulas" -- admin only
 	Route::resource('/membershipformula','MembershipFormulaController', ['except' =>['show', 'create', 'store']])->middleware('can:admin');
 	Route::get('/membershipformula/{id}/edit/{ed_type}','MembershipFormulaController@edit')->name('membershipformula.edit')->middleware('can:admin');
	Route::post('/membershipformula/update','MembershipFormulaController@update')->name('membershipformula.update')->middleware('can:admin');
	Route::post('/membershipformula/updatevariable','MembershipFormulaController@updatevariable')->name('membershipformula.updatevariable')->middleware('can:admin');

//-- "Enroll Membership Fee" -- admin && user
	//Grade School
 	Route::get('/gsenrollment','MembershipEnrollment\GsEnrollController@index')->name('gsenrollment.index')->middleware('can:admin-user');
 	Route::post('/gsenrollment','MembershipEnrollment\GsEnrollController@store')->name('gsenrollment.store')->middleware('can:admin-user');
	//High School
 	Route::get('/hsenrollment','MembershipEnrollment\HsEnrollController@index')->name('hsenrollment.index')->middleware('can:admin-user');
 	Route::post('/hsenrollment','MembershipEnrollment\HsEnrollController@store')->name('hsenrollment.store')->middleware('can:admin-user');
	//Basic Education
 	Route::get('/bedenrollment','MembershipEnrollment\BedEnrollController@index')->name('bedenrollment.index')->middleware('can:admin-user');
 	Route::post('/bedenrollment','MembershipEnrollment\BedEnrollController@store')->name('bedenrollment.store')->middleware('can:admin-user');
 	//College
 	Route::get('/colenrollment','MembershipEnrollment\ColEnrollController@index')->name('colenrollment.index')->middleware('can:admin-user');
 	Route::post('/colenrollment/fetch', 'MembershipEnrollment\ColEnrollController@fetch')->name('colenrollment.fetch')->middleware('can:admin-user');
 	//College Semester
 	Route::post('/colsemenrollment/','MembershipEnrollment\ColsemEnrollController@index')->name('colsemenrollment.index')->middleware('can:admin-user');
 	Route::post('/colsemenrollment/submit','MembershipEnrollment\ColsemEnrollController@store')->name('colsemenrollment.store')->middleware('can:admin-user');
 	//College Trimester
 	Route::post('/coltrienrollment/','MembershipEnrollment\ColtriEnrollController@index')->name('coltrienrollment.index')->middleware('can:admin-user');
 	Route::post('/coltrienrollment/submit','MembershipEnrollment\ColtriEnrollController@store')->name('coltrienrollment.store')->middleware('can:admin-user');
	//Graduate Education
 	Route::get('/gedenrollment','MembershipEnrollment\GedEnrollController@index')->name('gedenrollment.index')->middleware('can:admin-user');
 	Route::post('/gedenrollment/fetch', 'MembershipEnrollment\GedEnrollController@fetch')->name('gedenrollment.fetch')->middleware('can:admin-user');
 	//Graduate Education Semester
 	Route::post('/gedsemenrollment/','MembershipEnrollment\GedsemEnrollController@index')->name('gedsemenrollment.index')->middleware('can:admin-user');
 	Route::post('/gedsemenrollment/submit','MembershipEnrollment\GedsemEnrollController@store')->name('gedsemenrollment.store')->middleware('can:admin-user');
 	//Graduate Education Trimester
 	Route::post('/gedtrienrollment/','MembershipEnrollment\GedtriEnrollController@index')->name('gedtrienrollment.index')->middleware('can:admin-user');
 	Route::post('/gedtrienrollment/submit','MembershipEnrollment\GedtriEnrollController@store')->name('gedtrienrollment.store')->middleware('can:admin-user');

//-- "Manage Membership Fee" -- admin && user
 	//Grade School
 	Route::resource('/gsmembership','Memberships\GsMembershipController', ['except' =>['show', 'create', 'store']])->middleware('can:admin-user');
	Route::get('/gsmembership','Memberships\GsMembershipController@index')->name('gsmembership.index')->middleware('can:admin-user');
 	Route::get('/gsenrollment/{id}/{content}/edit','Memberships\GsMembershipController@edit')->name('gsenrollment.edit')->middleware('can:admin-user');
 	Route::post('/gsenrollment/update','Memberships\GsMembershipController@update')->name('gsenrollment.update')->middleware('can:admin-user');
 	//High School
 	Route::resource('/hsmembership','Memberships\HsMembershipController', ['except' =>['show', 'create', 'store']])->middleware('can:admin-user');
	Route::get('/hsmembership','Memberships\HsMembershipController@index')->name('hsmembership.index')->middleware('can:admin-user');
 	Route::get('/hsenrollment/{id}/{content}/edit','Memberships\HsMembershipController@edit')->name('hsenrollment.edit')->middleware('can:admin-user');
 	Route::post('/hsenrollment/update','Memberships\HsMembershipController@update')->name('hsenrollment.update')->middleware('can:admin-user');
 	//Basic Education
 	Route::resource('/bedmembership','Memberships\BedMembershipController', ['except' =>['show', 'create', 'store']])->middleware('can:admin-user');
	Route::get('/bedmembership','Memberships\BedMembershipController@index')->name('bedmembership.index')->middleware('can:admin-user');
 	Route::get('/bedenrollment/{id}/{content}/edit','Memberships\BedMembershipController@edit')->name('bedenrollment.edit')->middleware('can:admin-user');
 	Route::post('/bedenrollment/update','Memberships\BedMembershipController@update')->name('bedenrollment.update')->middleware('can:admin-user');
 	//College Semester
 	Route::resource('/colsemmembership','Memberships\ColsemMembershipController', ['except' =>['show', 'create', 'store']])->middleware('can:admin-user');
	Route::get('/colsemmembership','Memberships\ColsemMembershipController@index')->name('colsemmembership.index')->middleware('can:admin-user');
 	Route::get('/colsemenrollment/{id}/{content}/edit','Memberships\ColsemMembershipController@edit')->name('colsemenrollment.edit')->middleware('can:admin-user');
 	Route::post('/colsemenrollment/update','Memberships\ColsemMembershipController@update')->name('colsemenrollment.update')->middleware('can:admin-user');
 	//College Trimester
 	Route::resource('/coltrimembership','Memberships\ColtriMembershipController', ['except' =>['show', 'create', 'store']])->middleware('can:admin-user');
	Route::get('/coltrimembership','Memberships\ColtriMembershipController@index')->name('coltrimembership.index')->middleware('can:admin-user');
 	Route::get('/coltrienrollment/{id}/{content}/edit','Memberships\ColtriMembershipController@edit')->name('coltrienrollment.edit')->middleware('can:admin-user');
 	Route::post('/coltrienrollment/update','Memberships\ColtriMembershipController@update')->name('coltrienrollment.update')->middleware('can:admin-user');
 	//Graduate Education Semester
 	Route::resource('/gedsemmembership','Memberships\GedsemMembershipController', ['except' =>['show', 'create', 'store']])->middleware('can:admin-user');
	Route::get('/gedsemmembership','Memberships\GedsemMembershipController@index')->name('gedsemmembership.index')->middleware('can:admin-user');
 	Route::get('/gedsemenrollment/{id}/{content}/edit','Memberships\GedsemMembershipController@edit')->name('gedsemenrollment.edit')->middleware('can:admin-user');
 	Route::post('/gedsemenrollment/update','Memberships\GedsemMembershipController@update')->name('gedsemenrollment.update')->middleware('can:admin-user');
 	//Graduate Education Trimester
 	Route::resource('/gedtrimembership','Memberships\GedtriMembershipController', ['except' =>['show', 'create', 'store']])->middleware('can:admin-user');
	Route::get('/gedtrimembership','Memberships\GedtriMembershipController@index')->name('gedtrimembership.index')->middleware('can:admin-user');
 	Route::get('/gedtrienrollment/{id}/{content}/edit','Memberships\GedtriMembershipController@edit')->name('gedtrienrollment.edit')->middleware('can:admin-user');
 	Route::post('/gedtrienrollment/update','Memberships\GedtriMembershipController@update')->name('gedtrienrollment.update')->middleware('can:admin-user');

	//-- "Manage Membership Billing" -- admin && user
	Route::resource('/billing','BillingController', ['except' =>['show', 'create', 'store']])->middleware('can:admin-user');
	Route::get('/billing', 'BillingController@index')->name('billing.index')->middleware('can:admin-user');
	Route::get('/billing/{ids}/{idc}/{mscid}/pdf','BillingController@export_pdf')->name('billing.pdf')->middleware('can:admin-user');
	Route::get('/billing/{ids}/{idc}/{mscid}/pdf/download','BillingController@download_pdf')->name('download.pdf')->middleware('can:admin-user');

	//-- "Manage Original Receipts" -- admin && user
	Route::resource('/receipts','ReceiptsController', ['except' =>['show', 'create', 'store']])->middleware('can:admin-user');
	Route::get('/receipts', 'ReceiptsController@index')->name('receipts.index')->middleware('can:admin-user');
	Route::get('/receipts/{ids}/{idc}/{mscid}/verify', 'ReceiptsController@edit')->name('receipts.verify')->middleware('can:admin-user');
	Route::post('/receipts/verify/upload', 'ReceiptsController@update')->name('receipts.upload')->middleware('can:admin-user');
