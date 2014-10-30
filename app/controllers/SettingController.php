<?php

use Lang;

class SettingController extends \BaseController {

	private static $pageinfo;

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function __construct ()
	{
		// Set Page Info
		self::$pageinfo = [
			'menu' => [
				'pengaturan'
				],
			'content' => [
				'title' => trans('captions.setting.title.main'),
				'subtitle' => trans('captions.setting.subtitle.main')
			]
		];
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function showAplikasi()
	{
		// return 'something';
		$setting_name = 'aplikasi';
		$setting = Setting::where('name', '=', $setting_name)->firstOrFail();

		self::$pageinfo['menu'] = add_to_array(['pengaturan.aplikasi'], self::$pageinfo['menu']);

		return View::make('pages.setting_aplikasi', [
			'pageinfo' => self::$pageinfo,
			'setting_name' => $setting_name,
			'setting' => $setting,
		]);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function validateAplikasi($setting_name, $key_name)
	{
		$rules = array(
			'setting_name' => 'required',
			'pdam_nama' => 'required',
			'pdam_alamat' => 'required',
			);
		return Validator::make($setting_name, $rules);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function updateAplikasi()
	{
		$key_name = 'aplikasi';
		$errors = '';

		$posted_settings  = Input::all();

		$validator = $this->validateAplikasi($posted_settings, $key_name);

		if ($validator->fails())
		{
			// $errors = $validator->messages();
			$messages[0] = trans('setting.subtitle.main.fail');
		}
		else
		{
			// get default settings
			$declared_settings = Config::get('airminum.setting.'.$key_name);

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

		return Redirect::route('pengaturan.aplikasi')->with([
			'messages' => $messages
		]);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function showLaporan()
	{
		self::$pageinfo['menu'] = array_merge(['pengaturan.laporan'], self::$pageinfo['menu']);
		self::$pageinfo['content'] = array_merge(self::$pageinfo['content'], ['subtitle'=>'Pengaturan Laporan']);

		return View::make('pages.setting_laporan',[
			'pageinfo' => self::$pageinfo
		]);
	}
}
