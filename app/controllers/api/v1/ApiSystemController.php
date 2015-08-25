<?php

namespace Api\v1;

/**
* Class: ApiSystemController
*/
class ApiSystemController extends BaseApiController
{
	public function getReources()
	{
		$registeredApis = [
			'signin' => route('api.v1.signin'),

		];

		return self::response([
			'error' => 0,
			'message' => trans('system.routes.list'),
			'data' => $registeredApis
		]);
	}
}