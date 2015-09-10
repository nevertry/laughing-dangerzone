<?php

class PermissionSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('permissions')->truncate();

		$permissions_groups = [

			// Dashboard
			'dashboard' => [
				'dashboard',
				],

			// Analytics
			'analytics' => [
				'analytics',
				'analytics.answers',
				'analytics.winners',
				],

			// Riddles
			'riddles' => [
				'riddles',
				'riddles.index',
				'riddles.create',
				],

			// Guest
			'guests' => [
				'guests',
				'guests.index',
				'guests.answers',
				],

			// Character Mapping
			'charmaps' => [
				'charmaps',
				'charmaps.index',
				'charmaps.regenerate',
				],

			// Guest
			'settings' => [
				'settings',
				'settings.index',
				],
			];

		foreach ($permissions_groups as $permissions)
		{
			Permission::whereIn('name', $permissions)->delete();

			foreach ($permissions as $permission) {
				Permission::create(array('name' => $permission));
			}
		}
	}

}
