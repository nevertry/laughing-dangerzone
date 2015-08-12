<?php

use Lang;

class RiddleController extends \BaseController {

	private static $pageinfo;

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function __construct ()
	{
		// Set Page Info
		self::$pageinfo = [
			'menu' => [
				'riddles'
				],
			'content' => [
				'title' => trans('captions.setting.title.main'),
				'subtitle' => trans('captions.setting.subtitle.main')
			]
		];
	}

}
