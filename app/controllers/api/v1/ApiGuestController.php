<?php

namespace Api\v1;

/**
* Class: ApiGuestController
*/
class ApiGuestController extends BaseApiController
{
	/**
	 * Sign in or register guest.
	 */
	public function postSignIn()
	{
		$inputData = [
			'name' => \Input::get('name'),
			'email' => \Input::get('email')
		];

		// Validate Inputted Data
		$validate = \Guest::validate($inputData);
		if ($validate->passes())
		{
			$guest = \Guest::getOneByEmail($inputData['email']);

			// Register a new guest.
			if (!$guest)
			{
				return $this->postRegister();
			}
			// Found existing guest.
			else
			{
				// Check guest's riddle validity.
				$guest = \Guest::checkAssignedRiddle($guest);

				// Prepare data to return.
				self::$data    = $guest;

				// Message update for existing user.
				if ($inputData != $guest->name)
				{
					self::$message = trans('codeapi.guest.signin.success_name_different', ['attr_name' => $guest->name]);
				}
			}
		}
		// Cannot validate inputted Data
		else
		{
			self::$error   = 5000;
			self::$message = trans('codeapi.guest.signin.invalid_parameter');
			self::$data    = \Input::all();
		}

		return self::response();
	}

	/**
	 * Register guest.
	 *
	 * @return mixed Object, non-json formed.
	 */
	public function postRegister()
	{
		$inputData = [
			'name' => \Input::get('name'),
			'email' => \Input::get('email'),
		];

		// Validate Inputted Data, make sure this guest is fresh.
		$validate = \Guest::validateToCreate($inputData);
		if ($validate->passes())
		{
			$guest = \Guest::create($inputData);
			self::$data    = $guest;
		}
		// Cannot validate inputted Data
		else
		{
			self::$error   = 5000;
			self::$message = trans('codeapi.guest.register.invalid_parameter');
			self::$data    = \Input::all();
		}

		return self::response();
	}
}