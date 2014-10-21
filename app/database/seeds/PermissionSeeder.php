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

/*
masterdata	
masterdata.unit	masterdata.unit.crud
masterdata.pekerjaan	masterdata.pekerjaan.crud
masterdata.peralatan	masterdata.peralatan.crud
*/

		$permissions_groups = [
			// Master Data
			'masterdata' => [
				'masterdata.unit',
				'masterdata.pekerjaan',
				'masterdata.peralatan',
				// CRUD
				'masterdata.unit.crud',
				'masterdata.pekerjaan.crud',
				'masterdata.peralatan.crud'
				],

			// Tarif
			'tarif' => [
				'tarif.sk',
				'tarif.jenis',
				'tarif.peruntukan',
				// CRUD
				'tarif.sk.crud',
				'tarif.jenis.crud',
				'tarif.peruntukan.crud'
				],

			// Akuntansi
			'akuntansi' => [
				// CoA
				'akuntansi.akun',
				'akuntansi.akun.crud',
				// Jurnal
				'akuntansi.jurnal',
				'akuntansi.jurnal.crud'
			],

			// Pelanggan
			'pelanggan' => [
				'pelanggan.lihat',
				'pelanggan.lihat.semua',
				'pelanggan.lihat.calon',
				'pelanggan.lihat.teguran',
				'pelanggan.lihat.nonaktif',
				'pelanggan.lihat.dicabut',
				// CRUD
				'pelanggan.crud',
				// Atur Tagihan / Kasir
				'pelanggan.tagihan'
			],

			// Tagihan
			'tagihan' => [
				'tagihan.bulanan',
				'tagihan.rab',
				// CRUD
				'tagihan.bulanan.crud',
				'tagihan.rab.crud'
			],

			// Catat Meter
			'catatmeter' => [
				'catatmeter.tambah'
			],

			// Pengguna
			'pengguna' => [
				'pengguna.profil',
				'pengguna.id',
				'pengguna.grup',
				// CRUD
				'pengguna.id.crud',
				'pengguna.grup.crud',
			]
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
