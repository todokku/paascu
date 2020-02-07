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

	//member CRUD
	Route::get('/members/{id}/edit','MembersController@edit')->name('members.edit');
	Route::post('/members/update','MembersController@update')->name('members.update');
	Route::get('/members/{id}/delete','MembersController@destroy')->name('members.destroy');
	Route::get('/members/create','MembersController@create')->name('members.create');
	Route::post('/members/create','MembersController@store')->name('members.store');
});		
 
Route::get('/test', function () {
    return view('layouts.test');
});