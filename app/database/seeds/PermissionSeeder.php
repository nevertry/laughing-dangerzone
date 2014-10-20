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

		$permissions_groups = array(
			// Dashboard
			'dashboard' => array(
				'dashboard'
				),

			// Pengguna
			'pengguna' => array(
				'user',
				),

			// Groups
			'group' => array(
				'group',
				),

			// Menus
			'menu' => array(
				// Menus : tidak perlu
				//'menu',

				// Master Data
				'menu.Masterdata',

				// Akuntansi
				'menu.Akuntansi',

				// Pengguna
				'menu.Pengguna',
				'menu.SubPenggunaProfile',
				'menu.SubPenggunaList',
				'menu.SubPenggunaGroup',

				// Pengaturan
				'menu.Pengaturan',
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
