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
		0 => "Registered Guest",
	];

	protected $hidden = ['id', 'riddle_id', 'created_at', 'updated_at', 'status'];

	/**** Event Listener : Start ****/
	public static function boot()
	{
		parent::boot();

		$guestModel = new Guest();

		# Set Riddle on initial create
		static::creating(function($guest) use ($guestModel)
		{
			$guest->riddle_id = $guestModel->assignRiddle($guest);
		});
	}
	/**** Event Listener : End ****/

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

	public static function assignRiddle($guest)
	{
		# Check riddle_id, if empty/null then ::setRiddle()
		if (empty($guest->riddle_id))
		{
			return self::setRiddle();
		}

		return $guest->riddle_id;
	}

	public static function setRiddle()
	{
		# Get available Riddle ID from the 'POOL'.
		# Update guest's riddle_id.
		$riddlePools = self::getRiddlePools();
		$pickedRiddle = array_rand($riddlePools, 1);

		return $pickedRiddle;
	}

	public static function getRiddlePools()
	{
		return Riddle::select('id')->where('publish_status', '=', 1)->get()->keyBy('id')->toArray();
	}
}