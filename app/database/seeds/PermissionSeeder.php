<?php

class PermissionSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$permissions_groups = array(
			// Dashboard
			'dashboard' => array(
				'dashboard'
				),

			// Users
			'user' => array(
				'user',
				'user.create',
				'user.view',
				'user.edit',
				'user.delete'
				),

			// Groups
			'group' => array(
				'group',
				'group.create',
				'group.view',
				'group.edit',
				'group.delete'
				)
			);

		foreach ($permissions_groups as $permissions)
		{
			Permission::whereIn('name', $permissions)->delete();

			foreach ($permissions as $permission) {
				Permission::create(array('name' => $permission));
			}
		}
	}

}
