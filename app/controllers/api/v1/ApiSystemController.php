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
			'signin' => ['method' => 'post', 'route' => route('api.v1.signin')],
			'answer' => ['method' => 'post', 'route' => route('api.v1.answer')],
		];

		return self::response([
			'error' => 0,
			'message' => trans('codeapi.system.routes.list'),
			'data' => $registeredApis
		]);
	}
}