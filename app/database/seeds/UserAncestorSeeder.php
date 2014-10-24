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
		DB::table('groups')->truncate();

		// Set User Admin
		$this->forAdmin();

		// Set User Hublang
		$this->forHublang();
	}

	private function userCreator($user_data, $group_name, $permissions)
	{
		Sentry::getUserProvider()->create($user_data);

		if(DB::table('groups')->whereName($group_name)->count() == 0)
		{
			$given_permission = array();

			foreach ($permissions as $permission) {
				$given_permission[$permission] = 1;
			}

			Sentry::getGroupProvider()->create(array(
				'name'        => $group_name,
				'permissions' => $given_permission
				));
		}

		$user  = Sentry::getUserProvider()->findByLogin($user_data['email']);
		$group = Sentry::getGroupProvider()->findByName($group_name);
		$user->addGroup($group);
	}

	private function forAdmin()
	{
		$user_data = array(
			'email'       => 'admin@admin.com',
			'password'    => 'password',
			'first_name'  => 'Administrator',
			'activated'   => 1
			);
		$group_name = 'Administrator';
		$permissions = Permission::lists('name');

		$this->userCreator($user_data, $group_name, $permissions);
	}

	private function forHublang()
	{
		$user_data = array(
			'email'       => 'hublang@hublang.com',
			'password'    => 'password',
			'first_name'  => 'Hublang',
			'activated'   => 1
			);
		$group_name = 'Hublang';
		$permissions = [
			// Pelanggan
			//'pelanggan' => [
				'pelanggan',
				'pelanggan.crud',
				'pelanggan.lihat',
				// 'pelanggan.lihat.semua',
				// 'pelanggan.lihat.calon',
				'pelanggan.lihat.teguran',
				// 'pelanggan.lihat.nonaktif',
				// 'pelanggan.lihat.dicabut',
				'pelanggan.pengaduan',

				// Fungsional; Atur Tagihan / Kasir
				// 'pelanggan.tagihan'
			//]
		];

		$this->userCreator($user_data, $group_name, $permissions);
	}
}