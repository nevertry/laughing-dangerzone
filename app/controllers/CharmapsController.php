<?php

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
	 **/
	public function showIndex()
	{
		$charmaps = Charmap::all();

		return View::make('pages.charmaps.index', [
			'pageinfo' => self::$pageinfo,
			'content' => 'This is Charmaps index page.',
			'data_charmaps' => $charmaps
		]);
	}

	/**
	 * Charmaps edit page
	 *
	 * @return void
	 **/
	public function getEdit($letter)
	{
		$charmap = Charmap::getCharmapData($letter);

		return View::make('pages.charmaps.edit', [
			'pageinfo' => self::$pageinfo,
			'content' => 'This is Charmaps edit page.',
			'data_charmap' => $charmap
		]);
	}

	/**
	 * Charmaps update process
	 *
	 * @return void
	 **/
	public function postEdit($letter)
	{
		// return Input::all();

		$data_charmap = [
			'letter' => Input::get('charmap_letter'),
			'symbol' => Input::get('charmap_symbol'),
		];

		if ($letter != $data_charmap['letter'])
		{
			return Redirect::route('dashboard.charmaps.index')
				->withErrors("Invalid Letter given.")
				->withInput(Input::all());
		}

		$validate = Charmap::validate($data_charmap);

		if ($validate->passes())
		{
			$charmap = Charmap::getCharmapData($letter);

			if ($charmap)
			{
				try
				{
					$charmap->symbol = $data_charmap['symbol'];
					$charmap->save();
					$noErrors = true;
				}
				catch (Illuminate\Database\QueryException $e){
					$noErrors = false;
					die("here?");
					$errorMsg = $e->getMessage();
					$errorCode = $e->errorInfo[1];
					if($errorCode == 1062){
						$errorMsg = 'Duplicate e-mail entry detected.';
					}
				}

				if ($noErrors)
				{
					Session::flash('info', "Charmap {$letter} updated!");
				}
				else
				{
					return Redirect::route('dashboard.charmaps.edit', ['letter' => $letter])
						->withErrors($errorMsg)
						->withInput(Input::all());
				}
			}
			else
			{
				return Redirect::route('dashboard.charmaps.edit', ['letter' => $letter])
					->withErrors('Cannot find requested letter.')
					->withInput(Input::all());
			}
		}
		else
		{
			return Redirect::route('dashboard.charmaps.edit', ['letter' => $letter])
				->withErrors($validate->messages())
				->withInput(Input::all());
		}

		return Redirect::route('dashboard.charmaps.index');
	}
}
