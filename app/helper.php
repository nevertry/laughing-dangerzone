<?php

/**
 * print_r or var_dump variable's value in more readible form.
 *
 * @param mixed $var Variable to print.
 */
function printvar($var, $dump=false)
{
	echo '<pre>';

	if ($dump)
		var_dump($var);
	else
		print_r($var);

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
function ifset (&$var, $else = '') {
	return isset($var) && $var ? $var : $else;
}

function has_permission($permission_name)
{
	$user_permissions = User::getPermissions();
	return ((array_key_exists($permission_name, $user_permissions)) && ($user_permissions[$permission_name] == 1)) ? true : false;
}

function setActiveMenuClass($required_permission, $given_permission)
{
	return (in_array($required_permission, $given_permission)) ? 'active' : '';
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
