<?php

class UserController extends \BaseController {

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function getSignIn()
	{
		$redirect = Input::get('redirect');

		if( ! empty($redirect) )
		{
			Session::put('intendedUrl', $redirect);
		}

		return View::make('user.signin');
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function postSignIn()
	{
		$rules = array(
			'email' => 'required|email',
			'password' => 'required|min:6'
			);
		$validator = Validator::make(Input::all(), $rules);

		if ( $validator->fails() )
		{
			return Redirect::to('signin')->withErrors($validator)->withInput();
		}
		else
		{
			$credentials = array(
				'email'    => Input::get('email'),
				'password' => Input::get('password')
				);
			try
			{
				if(Input::get('remember_me') == '1')
				{
					$user = Sentry::authenticateAndRemember($credentials);
				}
				else
				{
					$user = Sentry::authenticate($credentials);
				}

				if ($user)
				{
					try
					{
						$throttle = Sentry::findThrottlerByUserId($user->id);
						$throttle->clearLoginAttempts();

						// $user->submit_reset_password_at = null;
						// $user->save();

						$redirect = Session::get('intendedUrl');

						if( ! empty($redirect))
						{
							Session::forget('intendedUrl');
							Session::forget('url.intended');
							return Redirect::to($redirect);
						}
						return Redirect::intended('dashboard');
					}
					catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
					{
						return Redirect::to('signin')->withErrors(array('login' => $e->getMessage()))->withInput();
					}
				}
			}
			catch (\Cartalyst\Sentry\Users\LoginRequiredException $e)
			{
				return Redirect::to('signin')->withErrors(array('login' => $e->getMessage()))->withInput();
			}
			catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e)
			{
				// Notify generated password token
				return Redirect::to('signin')->withErrors(array('login' => $e->getMessage()))->withInput();
			}
			// catch (\Cartalyst\Sentry\Users\WrongPasswordException $e)
			// {
			// 	// return Redirect::to('signin')->withErrors(array('login' => $e->getMessage()))->withInput();
			// 	return Redirect::to('signin')->withErrors(array('login' => Lang::get('validation.same')))->withInput();
			// }
			// catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
			// {
			// 	return Redirect::to('signin')->withErrors(array('login' => $e->getMessage()));
			// }
			// catch (\Cartalyst\Sentry\Users\UserNotActivatedException $e)
			// {
			// 	return Redirect::to('signin')->withErrors(array('login' => $e->getMessage()));
			// }
			// catch (\Cartalyst\Sentry\Throttling\UserSuspendedException $e)
			// {
			// 	$throttle = Sentry::findThrottlerByUserLogin(Input::get('email'));
			// 	$time = $throttle->getSuspensionTime();
			// 	return Redirect::to('signin')->withErrors(array('login' => "User is suspended for $time minutes."));
			// }
			// catch (\Cartalyst\Sentry\Throttling\UserBannedException $e)
			// {
			// 	return Redirect::to('signin')->withErrors(array('login' => $e->getMessage()));
			// }
			catch(\Exception $e)
			{
				return Redirect::to('signin')->withErrors(array('login' => Lang::get('validation.in', ['attribute' => 'id/password'])));
			}
		}
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function getSignOut()
	{
		Sentry::logout();
		Session::flush();
		Session::flash('status', Lang::get('captions.user.sign_out'));
		return Redirect::to('signin');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return User::all();
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
