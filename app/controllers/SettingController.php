<?php

class SettingController extends \BaseController {

	private static $pageinfo;

	/**
	 * Construct
	 *
	 * @return void
	 **/
	public function __construct ()
	{
		// Set Page Info
		self::$pageinfo = [
			'menu' => [
				'settings'
				],
			'content' => [
				'title' => trans('captions.setting.title.main'),
				'subtitle' => trans('captions.setting.subtitle.main')
			]
		];
	}

	/**
	 * Show Index Setting Page
	 *
	 * @return void
	 **/
	public function showAppIndex()
	{
		$setting_name = 'app';
		$setting = Setting::where('name', '=', $setting_name)->first();

		$setting = ($setting) ? $setting : Setting::resetSetting($setting_name);

		self::$pageinfo['menu'] = add_to_array(['settings.app'], self::$pageinfo['menu']);

		return View::make('pages.settings_app', [
			'pageinfo' => self::$pageinfo,
			'setting_name' => $setting_name,
			'setting' => $setting,
		]);
	}

	/**
	 * Validate Index Settings
	 *
	 * @return void
	 **/
	public function validateApp($setting_name, $key_name)
	{
		$rules = array(
			// 'setting_name' => 'required',
			// 'pdam_nama' => 'required',
			// 'pdam_alamat' => 'required',
			);
		return Validator::make($setting_name, $rules);
	}

	/**
	 * To update settings.
	 *
	 * @return void
	 **/
	public function postApp()
	{
		$key_name = 'app';
		$errors = '';

		$posted_settings  = Input::all();

		$validator = $this->validateApp($posted_settings, $key_name);

		if ($validator->fails())
		{
			// $errors = $validator->messages();
			$messages[0] = trans('setting.subtitle.main.fail');
		}
		else
		{
			// get default settings
			$declared_settings = Config::get('xkerangka.setting.'.$key_name);

			$updated_settings = array();

			foreach ($posted_settings as $key => $value) {

				// Check only needed values
				if ($key != '_token' && $key != 'setting_name')
				{
					// Check whether this is declared on settings
					if (array_key_exists($key, $declared_settings))
					{
						$updated_settings[$key]['type'] = $declared_settings[$key]['type'];
						$updated_settings[$key]['label'] = $declared_settings[$key]['label'];
						$updated_settings[$key]['tip'] = $declared_settings[$key]['tip'];
						$updated_settings[$key]['value'] = $value;
					}
				}
			}

			$setting = Setting::where('name','=', $key_name)->first();
			$setting->meta_data = json_encode($updated_settings);
			$setting->save();
			$messages[0] = trans('setting.subtitle.main.success');
		}

		return Redirect::route('dashboard.settings.app')->with([
			'messages' => $messages
		]);
	}

}
