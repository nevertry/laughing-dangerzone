<?php

class Guest extends \Eloquent {
	protected $table = "guests";

	public $timestamps = true;

	protected $fillable = ['id', 'email', 'name', 'riddle_id', 'status'];

	protected $appends = ['riddle'];

	private static $rules = [
		'email' => 'required|email',
		'name' => 'required',
	];

	protected static $allowed_status = [
		0 => "Registered Guest.",
		1 => "Registered Guest, gave correct answer.",
	];

	protected $hidden = ['id', 'riddle_id', 'created_at', 'updated_at', 'status'];

	/**** Event Listener : Start ****/
	public static function boot()
	{
		parent::boot();

		$guestModel = new Guest();

		// Set Riddle on success create, because riddles pools needs guest id.
		static::created(function($guest) use ($guestModel)
		{
			$guest->riddle_id = $guestModel->getRiddleId($guest);
			$guest->save();
		});
	}
	/**** Event Listener : End ****/

	public static function getStatusIdByText($status)
	{
		foreach (self::$allowed_status as $key => $value) {
			if (strtolower($value) == strtolower($status))
			{
				return $key;
			}
		}
		return -1;
	}

	public function getRiddleAttribute($value)
	{
		return $this->riddle_data();
	}

	public function riddle_data()
	{
		$riddle = new Riddle();

		try
		{
			$riddle = $riddle->where('id', '=', $this->riddle_id)->firstOrFail();
		}
		catch (Exception $e)
		{
			$riddle = false;
		}

		return $riddle;
	}

	public static function validate($data, $external_rules=array())
	{
		$rules = (count($external_rules)) ? $external_rules : self::$rules;

		return Validator::make($data, $rules);
	}

	public static function validateToCreate($data, $external_rules=array())
	{
		$external_rules = [
			'email' => 'required|email|unique:guests',
			'name' => 'required',
		];

		return self::validate($data, $external_rules);
	}

	public static function getOneByEmail($email)
	{
		try
		{
			$guest = Guest::where('email', '=', $email)->firstOrFail();
		}
		catch (Exception $e)
		{
			$guest = false;
		}
		return $guest;
	}

	public static function checkAssignedRiddle($guest)
	{
		if (empty($guest->riddle_id))
		{
			$guest->riddle_id = self::getRiddleId($guest);
		}

		$guest->save();
		
		return $guest;
	}

	public static function getRiddleId($guest)
	{
		# TODO: Check riddle is published?

		// Check riddle_id, if empty/null then ::setRiddle()
		if (empty($guest->riddle_id))
		{
			return self::setRiddle($guest->id);
		}

		return $guest->riddle_id;
	}

	public static function setRiddle($guest_id)
	{
		// Assign 'unique' riddle to each guest.
		$riddlePool = new RiddlesPool();
		$riddlePool = $riddlePool->getOneRiddle($guest_id);

		$riddle_id = null;

		if ($riddlePool)
		{
			$riddle_id = $riddlePool->riddle_id;
			Log::info('setRiddle: Found riddle candidate, id: '.$riddle_id);
		}
		else
		{
			Log::info('setRiddle: Cannot found riddle candidate id');
		}

		return $riddle_id;
	}

	public static function getRiddlePools()
	{
		return Riddle::getPublishedRiddleIds()->toArray();
	}

	public static function getCount($status='Registered Guest')
	{
		if (strtolower($status) == 'all')
		{
			return self::count();
		}

		return self::where('status', '=', self::getStatusIdByText($status))->count();
	}

}