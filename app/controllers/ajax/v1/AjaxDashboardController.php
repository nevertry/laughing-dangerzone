<?php

namespace Ajax\v1;

class AjaxDashboardController extends BaseAjaxController
{

	public function getRiddleCount()
	{
		self::$error   = 0;
		self::$data    = array('count' => 102);

		return self::response();
	}

	public function getGuestCount()
	{
		self::$error   = 0;
		self::$data    = array('count' => 62);

		return self::response();
	}

}