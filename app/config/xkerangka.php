<?php

return array(
	'app' => [
		'name' => 'XKerangka',
		'title' => 'XKerangka Master Tool',
	],
	'setting' => [
			'app' => [
				'app_name' => [
					'label'		=> 'Nama',
					'tip'		=> 'Masukkan Nama Aplikasi',
					'type'		=> 'text',
					'value'		=> 'Xkerangka',
					'default'	=> 'Xkerangka'
				],
			],
			'_app' => [
				'_app_name' => [
					'type'        => 'text',
					'label'       => 'Nama App',
					'placeholder' => 'Masukkan Nama Aplikasi',
					'default'     => 'Xkerangka App'
				],
				'_app_title' => [
					'label'       => 'Judul App',
					'placeholder' => 'Masukkan Judul Aplikasi',
					'default'     => 'XKerangka',
				]
			]
		]

);
