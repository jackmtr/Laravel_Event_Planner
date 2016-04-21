<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('testdb', function(){
    return (DB::table('users')->get());
});

Route::auth();




Route::group(['middleware' => 'auth'], function () {
	Route::get('/events', 'EventController@index');
	Route::get('/events/create', 'EventController@create');

	Route::get('/contacts', 'ContactController@index');
	Route::get('/contacts/create', 'ContactController@create');
	});
