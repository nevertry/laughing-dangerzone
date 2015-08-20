<?php

namespace Api\v1;

use \BaseController;

class BaseApiController extends BaseController
{
	public static function response($data, $code=200)
	{
		return \XApi::response($data, $code);
	}
}