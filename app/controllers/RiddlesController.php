<?php

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
	 * @return View
	 **/
	public function showIndex()
	{
		return View::make('pages.riddles.index', [
			'pageinfo' => self::$pageinfo,
			'content' => 'This is Riddles index page.',
			'data_riddles' => Riddle::getAllRiddles(),
		]);

	}

	/**
	 * Create Riddle page
	 *
	 * @return View
	 **/
	public function showCreate()
	{
		return View::make('pages.riddles.create', [
			'pageinfo' => self::$pageinfo,
			'riddle_data' => Input::old(),
		]);
	}

	/**
	 * Create Riddle Process (POST)
	 *
	 * @return void
	 **/
	public function postCreate()
	{
		// printvar(Input::all());
		// die();
		$riddle_data = [
			'type' => Input::get('riddle_type'),
			'content' => Input::get('riddle_content'),
			'question' => Input::get('riddle_question'),
			'answer' => Input::get('riddle_answer'),
			'clues' => Input::get('riddle_clues'),
			'publish_status' => Input::get('riddle_publish_status')
		];

		$validate = Riddle::validate($riddle_data);

		if ($validate->passes())
		{
			Riddle::create($riddle_data);
		}
		else
		{
			return Redirect::route('dashboard.riddles.create')
				->withErrors($validate->messages())
				->withInput(Input::all());
		}

		return (Input::has('createOnce')) ? Redirect::route('dashboard.riddles.index') : Redirect::route('dashboard.riddles.create');
	}

}
