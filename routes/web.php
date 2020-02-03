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


Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:admin-user')->group(function(){
	Route::resource('/users','UsersController', ['except' =>['show', 'create', 'store']]);
});

Route::get('/test', function () {
    return view('layouts.test');
});