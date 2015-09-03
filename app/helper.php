<?php

/**
 * print_r or var_dump variable's value in more readible form.
 *
 * @param mixed $var Variable to print.
 */
function printvar($var, $dump_method=0)
{
	echo '<pre>';

	switch ($dump_method) {
		case 1:
			var_dump($var);
			break;
		case 11:
			echo '<xmp>';
			var_dump($var);
			echo '</xmp>';
			break;
		case 10:
			echo '<xmp>';
			print_r($var);
			echo '</xmp>';
			break;
		case 0:
		default:
			print_r($var);
			break;
	}

	echo '</pre>';
}

/**
 * Return a value it has set, or else use default value.
 *
 * Usage:
 *   $a = 'potato';
 *
 *   echo ifset($a);           // outputs 'potato'
 *   echo ifset($a, 'carrot'); // outputs 'potato'
 *   echo ifset($b);           // outputs nothing
 *   echo ifset($b, 'carrot'); // outputs 'carrot'
 *
 * @param $var Initial value.
 * @param $else Else value.
 * @return $var or $else.
 */
function ifset ($var, $else = '') {
	return isset($var) ? $var : $else;
}

/**
 * Return a value of an object with parameter has set, or else use default value.
 *
 * @param $obj Object variable.
 * @param $objParam Object Parameter Name.
 * @param $else Else value.
 * @return $obj property or $else.
 */
function ifobset($obj, $objParam, $else='')
{
	if (is_object($obj))
		return (property_exists($obj, $objParam)) ? $obj->$objParam : $else;
	else
		return $else;
}

/**
 * Return a value of an array key has set, or else use default value.
 *
 * @param $arr Array variable.
 * @param $arrKey Array Key Name.
 * @param $else Else value.
 * @return $array key value or $else.
 */
function ifarrset($arr, $arrKey, $else='')
{
	if (is_array($arr))
		return (array_key_exists($arrKey, $arr)) ? $arr[$arrKey] : $else;
	else
		return $else;
}

/**
 * Return a value of an object or array with parameter/index has set, or else use default value.
 *
 * @param $ao Object variable.
 * @param $aoParam Object Parameter Name.
 * @param $else Else value.
 * @return $obj property or $else.
 */
function ifpset($ao, $aoPar, $else='')
{
	if (is_object($ao))
		return ifobset($ao, $aoPar, $else);
	elseif (is_array($ao))
		return ifarrset($ao, $aoPar, $else);
	else
		return $else;
}

/**
 * Check if user has correct permission.
 *
 * @param string $permission_name Permission to check.
 * @return boolean
 */
function has_permission($permission_name)
{
	$user_permissions = User::getPermissions();
	return ((array_key_exists($permission_name, $user_permissions)) && ($user_permissions[$permission_name] == 1)) ? true : false;
}

/**
 * [HTML] Set active class value
 *
 * @param string $required_permission Required permission to check.
 * @param string $given_permission Current given permission.
 * @return boolean
 */
function setActiveMenuClass($required_permission, $given_permission)
{
	return (in_array($required_permission, $given_permission)) ? 'active' : '';
}

/**
 * [HTML] set has-error class value
 *
 * @param boolean $has_error Error checked.
 * @return boolean
 */
function setClassHasError($has_error)
{
	return ($has_error) ? 'has-error' : '';
}

// Add tp array collection from array only
function add_to_array($new_array, $array_collections)
{
	if (is_array($new_array))
	{
		foreach ($new_array as $single_array) {
			if ($single_array)
			array_push($array_collections, $single_array);
		}
	}
	// elseif (is_string($new_array))
	// {
	// 	array_push($array_collections, $new_array);
	// }
	return $array_collections;
}

function parse_args( $args, $defaults = '' ) {
	if ( is_object( $args ) )
		$r = get_object_vars( $args );
	elseif ( is_array( $args ) )
		$r =& $args;
	else
		die('data should be array or object.');

	if ( is_array( $defaults ) )
		return array_merge( $defaults, $r );
	return $r;
}

function form_element_set($data, $data_key)
{
	$default = [
		'label' => '',
		'tip'   => '',
		'value' => '',
		'class' => ''
	];

	$data = parse_args($data, $default);

	$ret = '';
	switch ($data['type']) {
		case 'text':
			$ret  = '<div class="form-group ' . $data['class'] . '">';
			$ret .= '<label for="' . $data_key . '">' . $data['label'] . '</label>';
			$ret .=  '<input type="text" class="form-control" id="' . $data_key . '" name="' . $data_key . '" placeholder="' . $data['tip'] . '" value="' . $data['value'] . '">';
			$ret .= '</div>';
			break;
		case 'textarea':
			$ret  = '<div class="form-group ' . $data['class'] . '">';
			$ret .= '<label for="' . $data_key . '">' . $data['label'] . '</label>';
			$ret .=  '<textarea class="form-control" rows="3" placeholder="'. $data['tip'] .'">' . $data['value'] . '</textarea>';
			$ret .= '</div>';
			break;
		case 'dropdown': // single level dropdown
			$ret  = '<div class="form-group ' . $data['class'] . '">';
			$ret .= '<label for="' . $data_key . '">' . $data['label'] . '</label>';
			$ret .= '<select class="form-control selectize" name="' . $data_key . '">';
			foreach ($data['preset']['data'] as $key => $value) {
				$ret .= '<option value="' . $value[$data['preset']['field'][0]] . '">';
				$ret .= $value[$data['preset']['field'][1]];
				$ret .= '</option>';
			}
			$ret .= '</select>';
			$ret .= '</div>';
			break;
		case 'dropdown-with-child': // dropdown with child
			$ret  = '<div class="form-group ' . $data['class'] . '">';
			$ret .= '<label for="' . $data_key . '">' . $data['label'] . '</label>';
			$ret .= '<select class="form-control" name="' . $data_key . '">';
			foreach ($data['preset']['data'] as $key => $value) {
				$ret .= '<option value="' . $value[$data['preset']['field'][0]] . '">';
				$ret .= $value[$data['preset']['field'][1]];
				$ret .= '</option>';
			}
			$ret .= '</select>';
			$ret .= '</div>';
			break;
		default:
			# code...
			break;
	}

	return $ret;
}

function prependFirstArray($initial_array=array(), $first_array=array())
{
	return array_unshift($initial_array, $first_array);
}

function prependChar($string, $char=' ', $many=1)
{
	if ($many < 1) return $string;

	for ($i=0; $i < $many; $i++) { 
		$string = $char . $string;
	}
	return $string;
}

/**
 * Check for invalid formed json.
 *
 * @return false if no errors.
 */
function isNotJson($string)
{
	// decode the JSON data
	$result = json_decode($string);

	// switch and check possible JSON errors
	switch (json_last_error()) {
		case JSON_ERROR_NONE:
			$error = false; // JSON is valid // No error has occurred
			break;
		case JSON_ERROR_DEPTH:
			$error = 'The maximum stack depth has been exceeded.';
			break;
		case JSON_ERROR_STATE_MISMATCH:
			$error = 'Invalid or malformed JSON.';
			break;
		case JSON_ERROR_CTRL_CHAR:
			$error = 'Control character error, possibly incorrectly encoded.';
			break;
		case JSON_ERROR_SYNTAX:
			$error = 'Syntax error, malformed JSON.';
			break;
		// PHP >= 5.3.3
		case JSON_ERROR_UTF8:
			$error = 'Malformed UTF-8 characters, possibly incorrectly encoded.';
			break;
		// PHP >= 5.5.0
		case JSON_ERROR_RECURSION:
			$error = 'One or more recursive references in the value to be encoded.';
			break;
		// PHP >= 5.5.0
		case JSON_ERROR_INF_OR_NAN:
			$error = 'One or more NAN or INF values in the value to be encoded.';
			break;
		case JSON_ERROR_UNSUPPORTED_TYPE:
			$error = 'A value of a type that cannot be encoded was given.';
			break;
		default:
			$error = 'Unknown JSON error occured.';
			break;
	}

	return $error;
}

/**
 * Combine user attributes with known attributes and fill in defaults when needed.
 *
 * @param array $pairs Entire list of supported attributes and their defaults.
 * @param array $atts User defined attributes in shortcode tag.
 * @return array $out Combined and filtered attribute list.
 */
function arrayPairs($pairs, $atts)
{
	$atts = (array)$atts;
	$out = array();
	foreach($pairs as $name => $default) {
		if ( array_key_exists($name, $atts) )
			$out[$name] = $atts[$name];
		else
			$out[$name] = $default;
	}
	return $out;
}

/**
 * Generate slug from a string.
 *
 * @param string $str excluding attribute.
 * @param array $replace array of strings.
 * @param string $delimiter.
 * @return string clean string.
 */
function wordSlugger($str, $replace=array(), $delimiter='_') {
	// use locale ?
	// setlocale(LC_ALL, 'en_US.UTF8');

	if( !empty($replace) ) {
		$str = str_replace((array)$replace, ' ', $str);
	}

	$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

	return $clean;
}