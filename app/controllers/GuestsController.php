<?php

class GuestsController extends \BaseController {

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
	 * Guests index page
	 *
	 * @return void
	 * @author 
	 **/
	public function showIndex()
	{
		# Set Menu Permission
		self::addMenu(['guests.index']);

		$data_guests = Guest::all();

		return View::make('pages.guests.index', [
			'pageinfo' => self::$pageinfo,
			'content' => 'This is Guest index page.',
			'data_guests' => $data_guests
		]);

	}

	/**
	 * Update Guest
	 *
	 * @return void
	 **/
	public function getEdit($id)
	{
		# Set Menu Permission
		// self::addMenu(['guests.edit']); // unavailable

		try
		{
			$guest_data = Guest::findOrFail($id);
		}
		catch (Exception $e)
		{
			return Redirect::route('dashboard.guests.index')->withErrors($e->getMessage());
		}

		return View::make('pages.guests.edit', [
			'pageinfo' => self::$pageinfo,
			'guest_data' => $guest_data,
		]);
	}

	/**
	 * Update Riddle Process (POST)
	 *
	 * @return void
	 **/
	public function postEdit($id)
	{
		$guest_data = [
			'id' => Input::get('guest_id'),
			'email' => Input::get('guest_email'),
			'name' => Input::get('guest_name'),
			'riddle_id' => Input::get('guest_riddle_id'),
			'status' => Input::get('guest_status'),
		];

		$rules = [
			'email' => 'required|email:guests',
			'name' => 'required',
		];

		$validate = Guest::validate($guest_data, $rules);

		if ($validate->passes())
		{
			// Check with existing data
			if ($id != $guest_data['id'])
			{
				return Redirect::route('dashboard.guests.index')
					->withErrors("Invalid given ID.")
					->withInput(Input::all());
			}

			// Otherwise: OK
			// Get old data first
			$guest = Guest::find($guest_data['id']);

			$guest->email = $guest_data['email'];
			$guest->name = $guest_data['name'];
			$guest->riddle_id = $guest_data['riddle_id'];
			$guest->status = $guest_data['status'];

			// Update old data
			$noErrors = false;
			$errorMsg = 'Error occured.';
			try
			{
				$guest->save();
				$noErrors = true;
			}
			catch (Illuminate\Database\QueryException $e){
				$errorMsg = $e->getMessage();
				$errorCode = $e->errorInfo[1];
				if($errorCode == 1062){
					$errorMsg = 'Duplicate e-mail entry detected.';
				}
			}

			// Set session for informational purpose
			if ($noErrors)
			{
				Session::flash('info', "Guest #{$id} updated!");
			}
			else
			{
				// Session::flash('info', $errorMsg);
				return Redirect::route('dashboard.guests.edit', ['id' => $id])
					->withErrors($errorMsg)
					->withInput(Input::all());
			}			
		}
		else
		{
			return Redirect::route('dashboard.guests.edit', ['id' => $id])
				->withErrors($validate->messages())
				->withInput(Input::all());
		}

		return Redirect::route('dashboard.guests.index');
	}

	/**
	 * Delete Guest
	 */
	public function getDelete($id)
	{
		# Set Menu Permission
		// self::addMenu(['guests.delete']); // unavailable

		if (!empty($id))
		{
			// Do Delete
			$affectedRows = Guest::where('id', $id)->delete();

			if ($affectedRows)
			{
				// Set info once
				Session::flash('info', "Guest #{$id} deleted!");
			}
			else
			{
				// Set info once
				Session::flash('info', "Guest #{$id} not found. No gurst deleted.");
			}
		}

		return Redirect::route('dashboard.guests.index');
	}

	public function showAnswers()
	{
		$riddlesAnswers = \RiddlesAnswer::all();

		return View::make('pages.guests.answers.index', [
			'pageinfo' => self::$pageinfo,
			'data_answers' => $riddlesAnswers
		]);
	}
}
