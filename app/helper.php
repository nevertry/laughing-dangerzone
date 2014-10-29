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