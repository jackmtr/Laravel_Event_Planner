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
	//Route::post();
	Route::resource('events', 'EventController');//DOES EVERYTHING ABOVE
  	Route::post('/events/togglestatus', 'EventController@toggleStatus');
	Route::post('/events/{id}', 'EventController@show');
  	Route::post('/events/{id}', 'EventController@invitePreviousGuests');
  	Route::get('/events/{id}/duplicate', 'EventController@duplicate');

	//Route::get('/contacts', 'ContactController@index');//standard read all
	//Route::get('/contacts/create', 'ContactController@create');//standard create page
	//Route::get('/contacts/{id}', 'ContactController@show');	//standard read one
	//Route::post('/contacts', 'ContactController@store');//standard post creation page
	//Route::get('/contacts/{id}/edit', 'ContactController@edit');//standard show edit form
	//Route::patch('/contacts/{id}/edit', 'ContactController@update');//standard post edit
	Route::resource('contacts', 'ContactController');

  	Route::post('/guestlist/update', 'GuestListController@update');
	Route::post('/guestlist/create','GuestListController@store');
 	Route::post('/guestlist/checkin', 'GuestListController@checkin');
  	Route::post('/guestlist/addguests', 'GuestListController@addguests');
    Route::post('/guestlist/invite', 'GuestListController@invite');
    Route::post('/guestlist/createcontactguest', 'GuestListController@createContactGuest');
	Route::get('/guestlist/{id}/details','GuestListController@details');
	Route::post('guestlist/{id}/details','GuestListController@addPhone');


  	Route::get('/export/contacts', 'CSVController@exportContactList');


    Route::post('/import/contacts', 'CSVController@importContacts');
	Route::get('/export/guestlist/{event_id}', 'CSVController@exportGuestList');
    Route::get('/register', 'RegistrationController@register');
	Route::post('/register', 'RegistrationController@postRegister');
});
