<?php

class MasterWilayahController extends \BaseController {

	private static $pageinfo;

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function __construct()
	{
		self::$pageinfo = [
			'menu' => [
				'masterdata'
				],
			'content' => [
				'title' => 'Master Data',
				'subtitle' => 'Unit/Wilayah'
			]
		];
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// Show table list
		$wilayahs = MasterWilayah::with('childrenRecursive')->where('parent_id', '=', '0')->get();
		return View::make('pages.master_wilayah_list', compact('wilayahs'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$key_value_fields = ['id', 'name'];
		$wilayah_parents = MasterWilayah::parentOnly($key_value_fields)->get()->toArray();
		// echo '<pre>';
		// print_r($wilayah_parents);
		// exit;
		// return $wilayah_parents;

		$formdatas = [
			'code' => [
				'type'		=> 'text',
				'label'		=> 'Kode',
				'tip'		=> 'Masukkan Kode',
				'preset'	=> ''
			],
			'name' => [
				'type'		=> 'text',
				'label'		=> 'Nama',
				'tip'		=> 'Masukkan Nama',
				'preset'	=> ''
			],
			'description' => [
				'type'		=> 'text',
				'label'		=> 'Deskripsi',
				'tip'		=> 'Masukkan Deskripsi',
				'preset'	=> ''
			],
			'parent_id' => [
				'type'		=> 'dropdown',
				'label'		=> 'Parent',
				'tip'		=> 'Pilih Parent ID',
				'preset'	=> ['field'	=> $key_value_fields,
								'data'	=> $wilayah_parents],
			],
			// 'level' => [
			// 	'type'		=> 'text',
			// 	'label'		=> 'Level',
			// 	'tip'		=> '0/1/2', // fixed
			// 	'preset'	=> ''
			// ],
		];

		return View::make('pages.master_wilayah_add', [
			'pageinfo' => self::$pageinfo,
			'formdatas' => $formdatas,
		]);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
