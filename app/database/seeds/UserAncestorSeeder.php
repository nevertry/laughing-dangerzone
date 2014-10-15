<?php

class UserAncestorSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->truncate();
		DB::table('throttle')->truncate();
		DB::table('users_groups')->truncate();

		$user_data = array(
			'email'       => 'admin@admin.com',
			'password'    => 'password',
			'first_name'  => 'Administrator',
			'activated'   => 1
			);
		$group_name = 'Administrator';

		Sentry::getUserProvider()->create($user_data);

		if(DB::table('groups')->whereName('Administrator')->count() == 0)
		{
			$permissions = Permission::all();
			$all_permission = array();

			foreach ($permissions as $permission) {
				$all_permission[$permission->name] = 1;
			}

			Sentry::getGroupProvider()->create(array(
				'name'        => $group_name,
				'permissions' => $all_permission
				));
		}

		$user  = Sentry::getUserProvider()->findByLogin($user_data['email']);
		$group = Sentry::getGroupProvider()->findByName($group_name);
		$user->addGroup($group);
	}
}