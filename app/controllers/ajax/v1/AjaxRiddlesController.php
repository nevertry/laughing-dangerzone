<?php

namespace Ajax\v1;

class AjaxRiddlesController extends BaseAjaxController
{

	public function getAutoClues()
	{
		$riddle_data = [
			'read_as' => \Input::get('readAs'),
		];

		$autoClues = array(
			'autoclues_plain' => implode(',', \Charmap::getAutoClues($riddle_data['read_as'], $asHtml=false)),
			'autoclues_encoded' => implode(',', \Charmap::getAutoClues($riddle_data['read_as'], $asHtml=true))
			);

		self::$error   = 0;
		self::$data    = array('result' => $autoClues);

		return self::response();
	}

	public function parseCluesAsHtml()
	{

	}
}