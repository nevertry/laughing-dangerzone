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
		$data_riddles = [
			[
				'ID' => 1,
				'Instruction' => "Name an instrument.",
				'Type' => "Text",
				'Content' => "Usually it has six different strings.",
				'Clues' => "G1,U2,I3,T4,A5,R6",
				'Answer' => "GUITAR",
			],
			[
				'ID' => 2,
				'Instruction' => "What is the main color of the body of the figure?",
				'Type' => "Image",
				'Content' => Theme::asset('img/sample/instrument.jpg'),
				'Clues' => "R1,E2,D3",
				'Answer' => "RED",
			],
			[
				'ID' => 3,
				'Instruction' => "How many strings this instrument had?",
				'Type' => "Video",
				'Content' => Theme::asset('img/sample/instrument.jpg'),
				'Clues' => "S1,I2,X3",
				'Answer' => "SIX",
			],
			[
				'ID' => 4,
				'Instruction' => "In musical notes, C also known as ....",
				'Type' => "Audio",
				'Content' => Theme::asset('img/sample/instrument.jpg'),
				'Clues' => "D1,O2",
				'Answer' => "DO",
			]
		];

		return View::make('pages.riddles.index', [
			'pageinfo' => self::$pageinfo,
			'content' => 'This is Riddles index page.',
			'data_riddles' => $data_riddles,
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
