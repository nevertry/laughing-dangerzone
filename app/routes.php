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
});

Route::group(['prefix' => 'dashboard', 'before' => 'theme.backend|auth.sentry|hasAccess:dashboard'], function () {
	# Dashboard/Home
	Route::get('/', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);

	# Analytics
	Route::group(['prefix' => 'analytics', 'before' => 'hasAccess:analytics'], function () {
		// Analytics Index
		Route::get('/', function() {
			return Redirect::route('dashboard.analytics.index');
		});
		Route::get('index', ['as' => 'dashboard.analytics.index', 'uses' => 'AnalyticsController@showIndex']);
	});

	# Riddles
	Route::group(['prefix' => 'riddles', 'before' => 'hasAccess:analytics'], function () {
		// Riddles Index
		Route::get('/', function() {
			return Redirect::route('dashboard.riddles.index');
		});
		Route::get('index', ['as' => 'dashboard.riddles.index', 'uses' => 'RiddlesController@showIndex']);

		// Riddle create
		Route::get('create', ['as' => 'dashboard.riddles.create', 'uses' => 'RiddlesController@showCreate']);
		Route::post('create', ['as' => 'dashboard.riddles.create', 'uses' => 'RiddlesController@postCreate']);
	});

	# Guests
	Route::group(['prefix' => 'guests', 'before' => 'hasAccess:guests'], function () {
		// Guests Index
		Route::get('/', function() {
			return Redirect::route('dashboard.guests.index');
		});
		Route::get('index', ['as' => 'dashboard.guests.index', 'uses' => 'GuestsController@showIndex']);
	});

	# Charmaps : Letter-Symbol Mapping
	Route::group(['prefix' => 'charmaps', 'before' => 'hasAccess:charmaps'], function () {
		// Charmap Index
		Route::get('/', function() {
			return Redirect::route('dashboard.charmaps.index');
		});
		Route::get('index', ['as' => 'dashboard.charmaps.index', 'uses' => 'CharmapsController@showIndex']);
	});

	# Settings
	Route::group(['prefix' => 'settings', 'before' => 'hasAccess:settings|inGroup:Administrator'], function () {
		// Settings Index
		Route::get('/', function() {
			return Redirect::route('dashboard.settings.app');
		});
		Route::get('app', ['as' => 'dashboard.settings.app', 'uses' => 'SettingController@showAppIndex']);

		// Settings Update
		Route::post('app', ['as' => 'dashboard.settings.update', 'uses' => 'SettingController@postApp']);
	});

	# Pokemon (blocked)
	Route::group(['prefix' => 'error', 'before' => 'theme.backend'], function () {
		Route::get('/', function(){
			return View::make('pages.error', [
				'pageinfo' => ['content'=>['title'=>'Path Blocked', 'subtitle'=>'Admin on your way!']],
				]);
		});
	});

});

// User Session Control
Route::group(['before' => 'theme.backend'], function()
{
	Route::get('signin', ['as'=>'signin', 'uses'=>'UserController@getSignIn']);

	Route::post('signin', ['as'=>'signin', 'uses'=>'UserController@postSignIn']);

	Route::get('signout', ['as'=>'signout', 'uses'=>'UserController@getSignOut']);
});


