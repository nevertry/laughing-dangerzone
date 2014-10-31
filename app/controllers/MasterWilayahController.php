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
		$wilayah = MasterWilayah::all();

		return $wilayah;
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$formdatas = [
			'code' => [
				'label' => 'Kode',
				'tip'   => 'Masukkan Kode',
			],
			'name' => [
				'label' => 'Nama',
				'tip'   => 'Masukkan Nama',
			],
			'description' => [
				'label' => 'Deskripsi',
				'tip'   => 'Masukkan Deskripsi',
			],
			'parent_id' => [
				'label' => 'parent_id',
				'tip'   => 'Pilih Parent ID',
			],
			'level' => [
				'label' => 'Level',
				'tip'   => '1/2/3', // fixed
			],
		];

		return View::make('pages.master_wilayah', [
			'pageinfo' => self::$pageinfo,
			'formdata' => $formdatas,
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
		//
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
