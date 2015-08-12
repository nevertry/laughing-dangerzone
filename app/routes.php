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

// Query Debug
// Event::listen('illuminate.query', function($query){
// 	var_dump($query);
// });

Route::get('/', function()
{
	return Redirect::to('dashboard');
}
);

Route::group(['prefix' => 'dashboard', 'before' => 'theme.backend|auth.sentry'], function () {
	// Dashboard/Home
	Route::get('/', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);

	// Settings
	Route::group(['prefix' => 'settings'], function () {
		// Aplikasi Index
		Route::get('/', function() {
			return Redirect::route('dashboard.settings.app.index');
		});
		Route::get('app', ['as' => 'dashboard.settings.app.index', 'uses' => 'SettingController@appIndex']);

		// Aplikasi Update
		Route::post('app', ['as' => 'dashboard.settings.app.update', 'uses' => 'SettingController@appUpdate']);

	});

});

// User Session Control
Route::group(array('before' => 'theme.backend'), function()
{
	Route::get('signin', 'UserController@getSignIn');

	Route::post('signin', 'UserController@postSignIn');

	Route::get('signout', 'UserController@getSignOut');
});

