<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	protected $softDelete = true;

    /**
     * Name of Cache
     * @var array
     */
	public static $cache_prefix = 'XKerangka.';

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	static private function getPermissionCache($user)
	{
		$key = self::getCacheName($user->id);

		if(Cache::has($key))
		{
			// echo json_encode('dari cache');
			return Cache::get($key);
		}
		// echo json_encode('BUKAN dari cache');
		return self::setPermissionCache($user, $key);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	static private function setPermissionCache($user, $key)
	{
		$user_group = $user->getGroups()->first(); // get first group of user
		$group = Sentry::findGroupById($user_group->id);
		$group_permission = $group->getPermissions();

		// update cache
		Cache::add($key, $group_permission, 30);

		return $group_permission;
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	static public function getPermissions()
	{
		$user = Sentry::getUser();

		// Check cache first ftw
		return self::getPermissionCache($user);
	}

	/**
	 * User Logout
	 *
	 * @return void
	 * @author 
	 **/
	static public function getOut()
	{
		$user = Sentry::getUser();

		// delete cache from user
		if ($user)
		{
			Cache::forget(self::getCacheName($user->id));
		}
		Sentry::logout();

		return true;
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	static private function getCacheName ($uid)
	{
		return md5(self::$cache_prefix.$uid);
	}
}
