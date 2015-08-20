<?php

/**
 * API Wrapper in JSON format
 *
 * @version 0.0.3
 * @package Laravel
 * @author Hendy Yanuar <hendy.yanuar@gmail.com>
 **/
class XApi
{
    public static function response($data = array('error' => 0, 'data' => null, 'message' => null), $http_code = 200)
    {
        return Response::json(
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

        return XApi::response(array(
                'data' => $results,
                'error' => $error
            ));
    }
} // END class XApi