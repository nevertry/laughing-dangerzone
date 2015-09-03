<?php

namespace Ajax\v1;

class AjaxDashboardController extends BaseAjaxController
{

	public function getRiddleCount()
	{
		self::$error   = 0;
		self::$data    = array('count' => \Riddle::getCount());

		return self::response();
	}

	public function getGuestCount()
	{
		self::$error   = 0;
		self::$data    = array('count' => \Guest::getCount());

		return self::response();
	}

}