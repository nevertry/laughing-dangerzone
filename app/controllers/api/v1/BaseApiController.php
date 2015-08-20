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
		return self::generator([
			'error' => self::$error,
			'message' => self::$message,
			'data' => self::$data,
		], self::$code);
	}

    public static function generator($data = array('error' => 0, 'data' => null, 'message' => null), $http_code = 200)
    {
        return \Response::json(
            array(
                'error' =>   $data['error'],
                'message' => empty($data['message']) ? null : $data['message'],
                'data' => empty($data['data']) ? null : $data['data']
            ),
            $http_code
        );
    }

    public static function parser($datas, $error = 0, $numeric_check = true)
    {
        $results = array();
        $results['count'] = count($datas);
        $results['data'] = ($numeric_check) ? json_decode(json_encode($datas, JSON_NUMERIC_CHECK)) : $datas;

        return self::generator(array(
                'data' => $results,
                'error' => $error
            ));
    }
}