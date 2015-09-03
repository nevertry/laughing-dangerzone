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
			'signin' => [
				'method' => 'post',
				'route' => route('api.v1.signin'),
				'description' => 'Guest to sign in and get a riddle.'],
			'answer' => [
				'method' => 'post',
				'route' => route('api.v1.answer'),
				'description' => 'Guest to answer riddle'],
		];

		self::$error = 0;
		self::$message = trans('codeapi.system.routes.list');
		self::$data = $registeredApis;

		return self::response();
	}
}