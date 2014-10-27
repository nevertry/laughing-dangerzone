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
		// self::$pageinfo = ['menu'=>['pengaturan']];
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
		$data = array(
			'groups' => Group::all(),
			'settings' => Setting::all()
			);

		self::add_menu('pengaturan.aplikasi');

		return View::make('pages.setting')->with('pageinfo', self::$pageinfo);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function showLaporan()
	{
		self::add_menu('pengaturan.laporan');

		return View::make('pages.setting')->with('pageinfo', self::$pageinfo);
	}
}
