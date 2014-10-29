<?php

class SettingController extends \BaseController {

	private static $pageinfo = [
		'menu' => [
			'pengaturan'
			],
		'content' => [
			'title' => 'Pengaturan',
			'subtitle' => 'Pengaturan Aplikasi'
		]
	];

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function __construct ()
	{
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function add_menu($active_menus)
	{
		$current_active_menus = self::$pageinfo['menu'];

		if (is_array($active_menus))
		{
			foreach ($active_menus as $active_menu) {
				array_push($current_active_menus, $active_menu);
			}
		}
		elseif (is_string($active_menus))
		{
			array_push($current_active_menus, $active_menus);
		}
		return self::$pageinfo['menu'] = $current_active_menus;
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function showAplikasi()
	{
		$setting_val = Setting::where('name', '=', 'aplikasi');

		self::$pageinfo['menu'] = add_to_array(['pengaturan.aplikasi'], self::$pageinfo['menu']);

		return View::make('pages.setting_aplikasi', [
			'pageinfo' => self::$pageinfo,
			'settings' => $setting_aplikasi,
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
