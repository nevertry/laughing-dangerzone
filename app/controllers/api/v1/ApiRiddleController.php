<?php

namespace Api\v1;

/**
* Class: ApiGuestController
*/
class ApiRiddleController extends BaseApiController
{
	/**
	 * Sign in or register guest.
	 */
	public function postAnswer()
	{
		$inputData = [
			'email' => '',
			'riddle_id' => '',
			'answer' => '',
		];
		return self::response();
	}
}