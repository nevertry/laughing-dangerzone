<?php

class XApp extends \Eloquent {

	protected $table = "settings";

	protected $fillable = array(
		'name',
		'meta_data'
		);

	public $timestamps = true;

	private static $config_prefix = 'xkerangka.setting';

	/**
	 * Reset Setting to default value, default value, is taken from config file or, defined.
	 *
	 * @param $defaultFields Must be in JSON FORMED
	 */
	public static function resetSetting($keyName, $defaultFields=array())
	{
		$fields = json_encode($defaultFields);

		// Check default value is set, or take from config
		if (empty($defaultFields))
		{
			// Get Default Setting from config file, encode to JSON.
			$fields = json_encode(self::getDefaultConfig($keyName));
		}

		// Check for empty fields
		if (empty($fields))
		{
			// die('there');
			return false; // Cannot reset anything.
		}

		// Check for invalid Json
		if (isNotJson($fields))
		{
			return false;
		}

		// Replace: deleteOldSetting and createNewSetting
		$newSettings = self::replaceSetting($keyName, $fields);

		return ($newSettings) ? $newSettings : false;
	}

	public static function getDefaultConfig($keyName)
	{
		$defaultFields = Config::get(self::$config_prefix.'.'.$keyName);

		return $defaultFields;
	}

	public static function replaceSetting($keyName, $fields)
	{
		// Delete old key/value
		$affectedRows = self::where('name', '=', $keyName)->delete();

		// Create new key/value
		$newSetting = self::set($keyName, $fields);

		return $newSetting;
	}

	public static function set($keyName, $value)
	{
		$meta = XApp::firstOrNew(['name' => $keyName]);
		$meta->meta_data = $value;
		$meta->save();

		return $meta;
	}

	public static function get($keyName, $asJson=false)
	{
		$meta = false;
		$setting = self::where('name', '=', $keyName)->first();

		if ($asJson && $setting)
		{
			$setting = (array) json_decode($setting->meta_data);
		}
		elseif ($setting)
		{
			$setting = $setting->meta_data;
		}

		return ($setting) ? $setting : null;
	}

	/**
	 * Retrieve value of settings, try to get default config if not found.
	 * 
	 * @param mixed string of meta_data or boolean false.
	 */
	public static function retrieve($keyName)
	{
		$meta = false;
		$setting = self::get($keyName, 1); // as json

		if (!$setting)
		{
			// Try to get setting from config
			$resetSetting = self::resetSetting($keyName);
			if ($resetSetting)
			{
				$setting = (array) json_decode($resetSetting->meta_data);
			}
		}

		# assign value to settings
		$setting = self::assignSettingValue($setting);

		return $setting;
	}

	/**
	 * Assign value of setting, as 'value' parameter from saved data.
	 */
	public static function assignSettingValue($settingFields)
	{
		$arraySettings = array();

		if (empty($settingFields))
			return false;

		foreach ($settingFields as $keySF => $settingField) {
			$arraySetting = (array) $settingFields[$keySF];
			$arraySetting['type'] = array_key_exists('type', $arraySetting) ? $arraySetting['type'] : 'text';
			$arraySetting['label'] = array_key_exists('label', $arraySetting) ? $arraySetting['label'] : $keySF;
			$arraySetting['placeholder'] = array_key_exists('placeholder', $arraySetting) ? $arraySetting['placeholder'] : '';
			$arraySetting['tip'] = array_key_exists('tip', $arraySetting) ? $arraySetting['tip'] : '';
			$arraySetting['value'] = self::get($keySF);
			$arraySetting['default'] = array_key_exists('default', $arraySetting) ? $arraySetting['default'] : '';

			// Assign back
			$arraySettings[$keySF] = $arraySetting;

			// --- OR --- Using object
			// $settingFields[$keySF]->value = self::get($keySF);
			// TO RETURN: $settingFields
		}

		return $arraySettings;
	}

}