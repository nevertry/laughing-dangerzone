<?php

use Lang;

class RiddlesController extends \BaseController {

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
				'riddles'
				],
			'content' => [
				'title' => trans('captions.riddles.title.main'),
				'subtitle' => trans('captions.riddles.subtitle.main')
			]
		];
	}

	/**
	 * Riddles index page
	 *
	 * @return void
	 * @author 
	 **/
	public function showIndex()
	{
		return View::make('pages.riddles.index', [
			'pageinfo' => self::$pageinfo,
			'content' => 'This is Riddles index page.'
		]);

	}

	/**
	 * Create Riddle page
	 *
	 * @return void
	 * @author 
	 **/
	public function showCreate()
	{
		return View::make('pages.riddles.create', [
			'pageinfo' => self::$pageinfo,
		]);

	}
}
