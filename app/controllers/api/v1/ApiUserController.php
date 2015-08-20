<?php

namespace Api\v1;

/**
* Class: ApiUserController
*/
class ApiUserController extends BaseApiController
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