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

	//**BASIC REST PRACTICES**
	//Route::get('/events', 'EventController@index');//standard read all
	//Route::get('/events/create', 'EventController@create');//standard create page
	//Route::get('/events/{id}', 'GuestListController@show');//standard read one
	//Route::post('/events', 'EventController@store');//standard post creation page
	//Route::get('/events/{id}/edit', 'EventController@edit');//standard show edit form
	//Route::patch('/events/{id}/edit', 'EventController@update');//standard post edit

	Route::resource('events', 'EventController');//DOES EVERYTHING ABOVE

	//Route::get('/contacts', 'ContactController@index');//standard read all
	//Route::get('/contacts/create', 'ContactController@create');//standard create page
	//Route::get('/contacts/{id}', 'ContactController@show');	//standard read one
	//Route::post('/contacts', 'ContactController@store');//standard post creation page
	//Route::get('/contacts/{id}/edit', 'ContactController@edit');//standard show edit form
	//Route::patch('/contacts/{id}/edit', 'ContactController@update');//standard post edit

	Route::resource('contacts', 'ContactController');

	Route::post('/guestlist/create','GuestListController@store');
	//Route::resource('queries', 'ContactController');
	Route::get('/contacts/search','ContactController@search');
});
