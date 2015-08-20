<?php

namespace Api\v1;

use \BaseController;

class BaseApiController extends BaseController
{
	protected static $error = 0;
	protected static $message = 'Success.';
	protected static $data = null;
	protected static $code = 200;

	public static function response()
	{
		return \XApi::response([
			'error' => self::$error,
			'message' => self::$message,
			'data' => self::$data,
		], self::$code);
	}
}