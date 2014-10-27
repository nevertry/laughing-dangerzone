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