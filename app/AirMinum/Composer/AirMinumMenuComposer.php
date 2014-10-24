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
		// Set static page info
		$pageinfo = array('title' => 'Simpadu 2014');

		$view->with('pageinfo', $pageinfo);
	}
}