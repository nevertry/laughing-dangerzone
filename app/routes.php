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
		Route::get('/', ['as'=>'dashboard.riddles', 'uses' => function() {
				return Redirect::route('dashboard.riddles.index');
			}]);
		Route::get('index', ['as' => 'dashboard.riddles.index', 'uses' => 'RiddlesController@getIndex']);

		// Riddle create
		Route::get('create', ['as' => 'dashboard.riddles.create', 'uses' => 'RiddlesController@getCreate']);
		Route::post('create', ['as' => 'dashboard.riddles.create', 'uses' => 'RiddlesController@postCreate']);

		// Riddle edit
		Route::get('{id?}/edit', ['as' => 'dashboard.riddles.edit', 'uses' => 'RiddlesController@getEdit']);
		Route::post('{id?}/edit', ['as' => 'dashboard.riddles.edit', 'uses' => 'RiddlesController@postEdit']);

		// Riddle edit
		Route::get('{id?}/delete', ['as' => 'dashboard.riddles.delete', 'uses' => 'RiddlesController@getDelete']);

	});

	# Guests
	Route::group(['prefix' => 'guests', 'before' => 'hasAccess:guests'], function () {
		// Guests Index
		Route::get('/', ['as'=>'dashboard.guests', 'uses' => function() {
			return Redirect::route('dashboard.guests.index');
		}]);
		Route::get('index', ['as' => 'dashboard.guests.index', 'uses' => 'GuestsController@showIndex']);

		// Guest Edit
		Route::get('{id?}/edit', ['as' => 'dashboard.guests.edit', 'uses' => 'GuestsController@getEdit']);
		Route::post('{id?}/edit', ['as' => 'dashboard.guests.edit', 'uses' => 'GuestsController@postEdit']);

		// Guest Delete
		Route::post('{id?}/delete', ['as' => 'dashboard.guests.delete', 'uses' => 'GuestsController@getDelete']);
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
		Route::get('app', ['as' => 'dashboard.settings.app', 'uses' => 'SettingController@getIndex']);

		// Settings Update
		Route::post('app', ['as' => 'dashboard.settings.update', 'uses' => 'SettingController@postIndex']);
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


/*
|--------------------------------------------------------------------------
| API Routes V1
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'api', 'namespace' => 'Api\v1'], function() {
	/**
	* Route for API version 1.
	* url: /api/v1
	*/
	Route::group(['prefix' => 'v1'], function() {
		/**
		* GET Available Resource
		* url: /api/v1
		*/
		Route::get('/', [
			'as' => 'api.v1',
			'uses' => 'ApiSystemController@getReources'
		]);

		/**
		* Sign In (Register + Get riddle)
		* url: /api/v1/signin
		*/
		Route::post('/signin', [
			'as' => 'api.v1.signin',
			'uses' => 'ApiGuestController@postSignIn'
		]);

		/**
		* Answer Riddle
		* url: /api/v1/answer
		*/
		Route::post('/answer', [
			'as' => 'api.v1.answer',
			'uses' => 'ApiRiddleController@postAnswer'
		]);
	});
});

/*
|--------------------------------------------------------------------------
| AJAX Routes V1
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'ajax', 'namespace' => 'Ajax\v1', 'before' => 'auth.sentry|hasAccess:dashboard'], function() {
	/**
	* Route for AJAX version 1.
	* url: /ajax/v1
	*/
	Route::group(['prefix' => 'v1'], function() {
		/**
		* Riddle
		* url: /ajax/v1/riddle/count
		*/
		Route::get('/riddle/count', [
			'as' => 'ajax.v1.dashboard.riddle.count',
			'uses' => 'AjaxDashboardController@getRiddleCount'
		]);

		/**
		* Guest
		* url: /ajax/v1/guest/count
		*/
		Route::get('/guest/count', [
			'as' => 'ajax.v1.dashboard.guest.count',
			'uses' => 'AjaxDashboardController@getGuestCount'
		]);
	});
});
