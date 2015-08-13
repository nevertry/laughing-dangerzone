<?php

use Lang;

class GuestsController extends \BaseController {

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
				'guests'
				],
			'content' => [
				'title' => trans('captions.guests.title.main'),
				'subtitle' => trans('captions.guests.subtitle.main')
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
			'content' => 'This is Guest index page.'
		]);

	}
}
