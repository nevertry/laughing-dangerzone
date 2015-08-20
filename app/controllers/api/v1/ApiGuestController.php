<?php

namespace Api\v1;

/**
* Class: ApiGuestController
*/
class ApiGuestController extends BaseApiController
{
	public function postSignIn()
	{
		return self::response([
			'error' => 0,
			'message' => "No errors.",
			'data' => null
		]);
	}
}