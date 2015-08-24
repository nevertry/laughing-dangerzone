<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

if (!function_exists('appErrorResponse')):
function appErrorResponse($exception, $code)
{
	switch ($code) {
		case 400:
			$message = 'Bad Request.';
			break;
		case 401:
			$message = 'Unauthorized.';
			break;
		case 403:
			$message = 'Forbidden.';
			break;
		case 404:
			$message = 'Not Found.';
			break;
		case 405:
			$message = 'Method Not Allowed.';
			break;
		case 500:
			$message = 'Internal Server Error.';
			break;
		default:
			$message = 'Unknown Error.';
			break;
	}

	# Is trying to reach API?
	if (substr(Request::path(), 0, strlen('api/')) === 'api/')
	{
		// return;
		return Response::json([
			'error' => 9000,
			'message' => $message,
			'data' => null
		], $code);
	}
	# Other than: api/
	else
	{
		Theme::init('admin');
		return View::make('pages.error-missing');
	}
}
endif;

// When requested page is missing
App::missing(function(Exception $exception)
{
	return appErrorResponse($exception, 404);
});

// Otherwise, any error
App::error(function(Exception $exception, $code)
{
	return appErrorResponse($exception, $code);
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Sentry Filter
|--------------------------------------------------------------------------
*/
Route::filter('auth.sentry', function()
{
	if ( ! Sentry::check()) return Redirect::to('signin');
});

/*
|--------------------------------------------------------------------------
| hasAcces filter (permissions)
|--------------------------------------------------------------------------
|
| Check if the user has permission (group/user)
|
*/
Route::filter('hasAccess', function($route, $request, $value)
{
	try
	{
		$user = Sentry::getUser();

		if( ! $user->hasAccess($value))
		{
			return Redirect::route('signin')->withErrors(array(Lang::get('user.noaccess')));
		}
	}
	catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
	{
		return Redirect::route('signin')->withErrors(array(Lang::get('user.notfound')));
	}

});

/*
|--------------------------------------------------------------------------
| inGroup filter
|--------------------------------------------------------------------------
|
| Check if the user belongs to a group
|
*/
Route::filter('inGroup', function($route, $request, $value)
{
	try
	{
		$user = Sentry::getUser();

		$group = Sentry::findGroupByName($value);

		if( ! $user->inGroup($group))
		{
			return Redirect::route('signin')->withErrors(array(Lang::get('user.noaccess')));
		}
	}
	catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
	{
		return Redirect::route('signin')->withErrors(array(Lang::get('user.notfound')));
	}
	catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
	{
		return Redirect::route('signin')->withErrors(array(Lang::get('group.notfound')));
	}
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});


/*
|--------------------------------------------------------------------------
| Theme Filter
|--------------------------------------------------------------------------
*/

Route::filter('theme.backend', function() {
    Theme::init('admin');
});


/*
|--------------------------------------------------------------------------
| View Composer
|--------------------------------------------------------------------------
*/

// View::composer('layouts.default', function($view)
// {
//   $view->with('title', 'Replaced Title');
// });
