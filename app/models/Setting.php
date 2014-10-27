<?php

use Eloquent;

class Setting extends Eloquent {

	protected $table = "settings";

	protected $fillable = array(
		'name',
		'meta_data'
		);

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public static function value($name, $meta_data)
	{
		$setting = Setting::where('name', '=', $name)->first()->meta_data;
		$setting = json_decode($setting);

		return $setting->$meta_data;
	}
}