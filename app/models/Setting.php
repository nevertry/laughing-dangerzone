<?php

class Setting extends \Eloquent {

	protected $table = "settings";

	protected $fillable = array(
		'name',
		'meta_data'
		);

	public $timestamps = true;

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	// public static function value($name, $meta_data)
	// {
	// 	$setting = Setting::where('name', '=', $name)->first()->meta_data;
	// 	$setting = json_decode($setting);

	// 	return $setting->$meta_data;
	// }

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public static function resetSetting($key)
	{
		// delete when found
		Setting::where('name', '=', $key)->delete();

		// create setting
		return Setting::create([
			'name' => $key,
			'meta_data' => json_encode(Config::get('xkerangka.setting.'.$key))
			]);

////
		// Setting::where('name', '=', $key)->delete();

		// $setting = Setting::create([
		// 	'name' => $key,
		// 	'meta_data' => Config::get('airminum.setting.'.$key),
		// 	]);
////
		// Setting::where('name', '=', $key)->delete();
		// $setting = Setting::where('name', '=', $key)->get();
		// if ($setting)
		// {
		// 	$setting->meta_data = Config::get('airminum.'.$key);
		// }
		// else
		// {
		// 	$setting->name = $key;
		// 	$setting->meta_data = Config::get('airminum.'.$key);
		// }
		// $setting->save();
	}
}