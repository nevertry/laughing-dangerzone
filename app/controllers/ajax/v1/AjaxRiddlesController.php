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
			'autoclues_plain' => implode(',', \Charmap::getAutoClues($riddle_data['read_as'], $asHtml=false, $implode=false)),
			'autoclues_encoded' => implode(',', \Charmap::getAutoClues($riddle_data['read_as'], $asHtml=true, $implode=false))
			);

		self::$error   = 0;
		self::$data    = array('result' => $autoClues);

		return self::response();
	}

	public function generateClues()
	{
		$riddle_data = [
			'id' => \Input::get('riddle_id'),
		];

		$riddleWithAutoClues = \Charmap::generateClues($riddle_data['id']);

		if ($riddleWithAutoClues === false)
		{
			self::$error   = 9000;
			self::$message = 'Invalid Riddle ID?';
			self::$data    = ['id' => $riddle_data['id']];
		}
		else
		{
			self::$data    = $riddleWithAutoClues;
		}

		return self::response();
	}

	public function getIds()
	{
		$riddlesIds = array_keys(\Riddle::getPublishedRiddleIds()->toArray());

		if (count($riddlesIds))
		{
			self::$data    = $riddlesIds;
		}
		else
		{
			self::$error   = 9000;
			self::$message = 'Cannot get riddles IDs.';
			self::$data    = [];
		}

		return self::response();
	}

}