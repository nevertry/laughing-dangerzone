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
	public function getIndex()
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
	public function getCreate()
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

	/**
	 * Update Riddle
	 *
	 * @return void
	 **/
	public function getEdit($id)
	{
		try
		{
			$riddle_data = Riddle::findOrFail($id);
		}
		catch (Exception $e)
		{
			return Redirect::route('dashboard.riddles.index')->withErrors($e->getMessage());
		}

		return View::make('pages.riddles.edit', [
			'pageinfo' => self::$pageinfo,
			'riddle_data' => $riddle_data,
		]);
	}

	/**
	 * Update Riddle Process (POST)
	 *
	 * @return void
	 **/
	public function postEdit($id)
	{
		$riddle_data = [
			'id' => Input::get('riddle_id'),
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
			# Check with existing data
			if ($id != $riddle_data['id'])
			{
				return Redirect::route('dashboard.riddles.index')
					->withErrors("Invalid given ID.")
					->withInput(Input::all());
			}

			# Otherwise: OK
			# Get old data first
			$riddle = Riddle::find($riddle_data['id']);

			$riddle->type = $riddle_data['type'];
			$riddle->content = $riddle_data['content'];
			$riddle->question = $riddle_data['question'];
			$riddle->answer = $riddle_data['answer'];
			$riddle->clues = $riddle_data['clues'];
			$riddle->publish_status = $riddle_data['publish_status'];

			# Update old data
			$riddle->save();

			# Set session for informational purpose
			Session::flash('info', "Riddle #{$id} updated!");
		}
		else
		{
			return Redirect::route('dashboard.riddles.edit', ['id' => $id])
				->withErrors($validate->messages())
				->withInput(Input::all());
		}

		return Redirect::route('dashboard.riddles.index');
	}

	/**
	 * Delete Riddle Process
	 *
	 * @return void
	 **/
	public function getDelete($id)
	{
		if (!empty($id))
		{
			# Do Delete
			$affectedRows = Riddle::where('id', $id)->delete();

			if ($affectedRows)
			{
				# Set info once
				Session::flash('info', "Riddle #{$id} deleted!");
			}
			else
			{
				# Set info once
				Session::flash('info', "Riddle #{$id} not found. No riddle deleted.");
			}
		}

		return Redirect::route('dashboard.riddles.index');
	}
}
