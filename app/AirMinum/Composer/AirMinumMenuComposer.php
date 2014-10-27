<?php namespace AirMinum\Composer;

use User;

class AirMinumMenuComposer {

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function compose($view)
	{
		// retrieve data passed to view
		$viewdata = $view->getData();

		// Default pageinfo
		// $pageinfo_default = User::getPermissions();

		// Default Menu
		$menu_default = ['dashboard'];
		$pageinfo['menu'] = (!empty($viewdata['pageinfo']['menu'])) ? $viewdata['pageinfo']['menu'] : $menu_default;

		$view->with('pageinfo', $pageinfo);
	}

}