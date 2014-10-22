<?php namespace AirMinum\Composer;

class AirMinumMenuComposer {

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
		$userdata = 'static';

		$view->with('menus', $menus)->with('userdata', $userdata);
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