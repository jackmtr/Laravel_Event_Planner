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

Route::auth();

Route::group(['middleware' => 'auth'], function () {
	Route::get('/events', 'EventController@index');
	Route::get('/events/create', 'EventController@create');
	Route::post('/events/create', 'EventController@store');

	Route::get('/events/{id}', 'GuestListController@show');
	Route::get('/events/{id}/edit', 'EventController@edit');
	Route::post('/events/{id}/edit', 'EventController@update');

	Route::get('/contacts', 'ContactController@index');
	Route::get('/contacts/create', 'ContactController@create');
	Route::post('/contacts/create', 'ContactController@store');


	Route::post('/guestlist/create','GuestListController@store');


	Route::get('/contacts/{id}', 'ContactController@show');
	Route::get('/contacts/{id}/edit', 'ContactController@edit');
	Route::post('/contacts/{id}/edit', 'ContactController@update');
	
});

