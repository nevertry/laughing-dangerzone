<?php

use Lang;

class CharmapsController extends \BaseController {

	private static $pageinfo;

	/**
	 * Contstuct
	 *
	 * @return void
	 **/
	public function __construct ()
	{
		// Set Page Info
		self::$pageinfo = [
			'menu' => [
				'charmaps'
				],
			'content' => [
				'title' => trans('captions.charmaps.title.main'),
				'subtitle' => trans('captions.charmaps.subtitle.main')
			]
		];
	}

	/**
	 * Charmaps index page
	 *
	 * @return void
	 * @author 
	 **/
	public function showIndex()
	{
		return View::make('pages.empty', [
			'pageinfo' => self::$pageinfo,
			'content' => 'This is Charmaps index page.'
		]);

	}
}
