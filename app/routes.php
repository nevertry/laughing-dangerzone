<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Route::get('/', function()
// {
// 	return View::make('hello');
// });

Route::group(['prefix' => 'dashboard', 'before' => 'theme.backend|auth.sentry'], function () {

	Route::get('/', ['uses' => 'DashboardController@index']);

});

Route::group(array('before' => 'theme.backend'), function()
{
	Route::get('signin', 'UserController@getSignIn');

	Route::post('signin', 'UserController@postSignIn');

	Route::get('signout', 'UserController@getSignOut');
});

