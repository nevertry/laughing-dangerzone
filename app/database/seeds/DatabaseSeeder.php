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

		// $this->call('PermissionSeeder');
		// $this->call('UserAncestorSeeder');
		// $this->call('SettingSeeder');
		// $this->call('RiddleSeeder');
		// $this->call('CharmapSeeder');

		# New menu Regenerate Riddle's Clues
		# Notes: Please logout then login again to apply new permission to user permission
		$this->call('PermissionSeeder');
		$this->call('UserAncestorSeeder');
	}

}
