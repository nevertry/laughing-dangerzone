<?php

class SettingSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('settings')->truncate();

		$settings = Config::get('airminum.setting');

		foreach ($settings as $setting_name => $setting_value)
		{
			Setting::create([
				'name' => $setting_name,
				'meta_data' => json_encode($setting_value),
			]);
		}
	}

}
