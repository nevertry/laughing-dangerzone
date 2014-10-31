<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('PermissionSeeder');
		$this->call('UserAncestorSeeder');
		$this->call('SettingSeeder');
	}

}
