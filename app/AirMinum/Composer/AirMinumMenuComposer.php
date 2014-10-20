<?php namespace AirMinum\Composer;

class AirMinumMenuComposer {
	
	public function compose($view)
	{
		$menus = array('Master Data', 'Pengguna', 'Pengaturan');
		$view->with('menus', $menus);
	}
}