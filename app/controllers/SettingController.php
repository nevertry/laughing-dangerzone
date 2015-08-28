<?php

class SettingController extends \BaseController {

	private static $pageinfo;

	private static $settingAppPrefix = 'xkerangka.setting';
	private static $settingApp = '_app';
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

	public function getIndex()
	{
		# Set Menu Permission
		self::$pageinfo['menu'] = add_to_array(['settings.app'], self::$pageinfo['menu']);

		# Get setting meta_data, this is to determine <form> field in view.
		$setting_name = self::$settingApp;
		$settings = XApp::retrieve($setting_name);

		return View::make('pages.settings_app', [
			'pageinfo' => self::$pageinfo,
			'setting_name' => $setting_name,
			'settings' => $settings,
			'settings_excluded' => [], //['_app_title']
		]);
	}

	public function postIndex()
	{
		$settingApp = self::$settingApp;
		$settingAppPrefix = self::$settingAppPrefix;
		$errors = '';

		$inputData = Input::all();

		$validator = $this->validateApp($inputData, $settingApp);

		if ($validator->fails())
		{
			// $errors = $validator->messages();
			$messages[0] = trans('setting.subtitle.main.fail');
		}
		else
		{
			// get default settings
			$declared_settings = Config::get($settingAppPrefix.'.'.$settingApp);

			$updated_settings = array();

			foreach ($inputData as $key => $value) {

				// Check only needed values
				if ($key != '_token' && $key != 'setting_name')
				{
					// Check whether this is declared on settings
					if (array_key_exists($key, $declared_settings))
					{
						XApp::set($key, $value);
					}
				}
			}

			$messages[0] = trans('setting.subtitle.main.success');
		}

		return Redirect::route('dashboard.settings.app')->with([
			'messages' => $messages
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
			// '_app_name' => 'required',
			);
		return Validator::make($setting_name, $rules);
	}
}
