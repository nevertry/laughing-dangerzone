<?php

class BaseController extends Controller {

	public static $pageinfo;

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	private static function addMenu($arrayOfMenu)
	{
		self::$pageinfo['menu'] = add_to_array($arrayOfMenu, self::$pageinfo['menu']);
	}

}
