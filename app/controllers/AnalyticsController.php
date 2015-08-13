<?php

use Lang;

class AnalyticsController extends \BaseController {

	private static $pageinfo;

	/**
	 * Construct
	 *
	 * @return void
	 **/
	public function __construct ()
	{
		// Set Page Info
		self::$pageinfo = [
			'menu' => [
				'analytics'
				],
			'content' => [
				'title' => trans('captions.analytics.title.main'),
				'subtitle' => trans('captions.analytics.subtitle.main')
			]
		];
	}

	/**
	 * Analytics index page
	 *
	 * @return void
	 * @author 
	 **/
	public function showIndex()
	{
		return View::make('pages.empty', [
			'pageinfo' => self::$pageinfo,
			'content' => 'This is Analytics index page.'
		]);

	}

}
