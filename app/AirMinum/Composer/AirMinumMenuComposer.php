<?php namespace AirMinum\Composer;

class AirMinumMenuComposer {

	public function __construct (\AirMinum\Storage\User\UserRepository $user)
	{
		$this->user = $user;
		// $this->permission = \Permissions::all();
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function compose($view)
	{
		// pull from cache later?
		$menus = ['1','2','3'];

		$view->with('menus', $menus);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	private function getSystemPermissions()
	{
		return $this->permission->toArray();
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	private function getUserPermissions()
	{
		return $this->user->getPermissions();
	}

}