<?php

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
		case 'dropdown':
			$ret  = '<div class="form-group ' . $data['class'] . '">';
			$ret .= '<label for="' . $data_key . '">' . $data['label'] . '</label>';

			// $dropdown_data = array();

			$ret .= '<select class="form-control">';
			foreach ($data['preset']['data'] as $key => $value) {
				// $dropdown_data = array_push($dropdown_data, [$data['preset']['field'][0], $data['preset']['field'][1]]);
				$ret .= '<option value="' . $value[$data['preset']['field'][0]] . '">';
				$ret .= $value[$data['preset']['field'][1]];
				$ret .= '</option>';
			}
			$ret .= '</select>';
			// $ret .= Form::select($data_key, $dropdown_data);
			$ret .= '</div>';
			break;
		default:
			# code...
			break;
	}

    return $ret;
}