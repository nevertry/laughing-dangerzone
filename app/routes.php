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
	Route::get('signin', 'UserController@getSignIn');

	Route::post('signin', 'UserController@postSignIn');

	Route::get('signout', 'UserController@getSignOut');
});


