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
			// Master Data
			'masterdata' => [
				'masterdata',
				'masterdata.wilayah',
				'masterdata.wilayah.crud',
				'masterdata.pekerjaan',
				'masterdata.pekerjaan.crud',
				'masterdata.peralatan',
				'masterdata.peralatan.crud'
				],

			// Tarif
			'tarif' => [
				'tarif',
				'tarif.sk',
				'tarif.sk.crud',
				'tarif.jenis',
				'tarif.jenis.crud',
				'tarif.peruntukan',
				'tarif.peruntukan.crud'
				],

			// Akuntansi
			'akuntansi' => [
				'akuntansi',
				// CoA
				'akuntansi.akun',
				'akuntansi.akun.crud',
				// Jurnal
				'akuntansi.jurnal',
				'akuntansi.jurnal.crud'
			],

			// Pelanggan
			'pelanggan' => [
				'pelanggan',
				'pelanggan.crud',
				'pelanggan.lihat',
				'pelanggan.lihat.semua',
				'pelanggan.lihat.calon',
				'pelanggan.lihat.teguran',
				'pelanggan.lihat.nonaktif',
				'pelanggan.lihat.dicabut',
				'pelanggan.pengaduan',

				// Fungsional; Atur Tagihan / Kasir
				'pelanggan.tagihan'
			],

			// Tagihan
			'tagihan' => [
				'tagihan',
				'tagihan.bulanan',
				'tagihan.bulanan.crud',
				'tagihan.rab',
				'tagihan.rab.crud'
			],

			// Catat Meter
			'catatmeter' => [
				'catatmeter',
				'catatmeter.crud',
				'catatmeter.tambah'
			],

			// Pengguna
			'pengguna' => [
				'pengguna',
				'pengguna.profil',
				'pengguna.id',
				'pengguna.id.crud',
				'pengguna.grup',
				'pengguna.grup.crud'
			],

			// Pengaturan
			'pengaturan' => [
				'pengaturan',
				'pengaturan.aplikasi',
				'pengaturan.laporan'
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
