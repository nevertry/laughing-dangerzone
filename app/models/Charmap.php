<?php

class Charmap extends \Eloquent {
	protected $table = "charmaps";

	public $timestamps = true;

	protected $fillable = ['letter', 'symbol'];

	protected $hidden = ['created_at', 'updated_at'];

	protected static $rules = [
		'letter' => 'required',
		'symbol' => 'required',
	];

	public static function validate($data, $external_rules=array())
	{
		$rules = (count($external_rules)) ? $external_rules : self::$rules;

		return Validator::make($data, $rules);
	}
}