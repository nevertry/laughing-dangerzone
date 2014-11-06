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
		return View::make('pages.master_wilayah_list', [
			'wilayahs' => $wilayahs,
			'pageinfo' => self::$pageinfo
		]);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$key_value_fields = ['id', 'name'];

		$wilayah_parents = MasterWilayah::forDropdownSelect();
		array_unshift($wilayah_parents, ['id'=> '0', 'name'=>'[ --- Wiayah Baru --- ]']);

		$formdatas = [
			'parent_id' => [
				'type'		=> 'dropdown',
				'label'		=> 'Parent',
				'tip'		=> 'Pilih Parent ID',
				'preset'	=> ['field'	=> $key_value_fields,
								'data'	=> $wilayah_parents],
			],
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
		];

		return View::make('pages.master_wilayah_create', [
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
		// Get all inputs
		$inputs  = Input::all();

		// validate
		$validator = MasterWilayah::validate($inputs);

		// error messages
		$messages = array();

		// check validation
		if ($validator->fails())
		{
			$messages[0] = $validator->errors()->first();
			// return $validator->errors();
		}
		else
		{
			// Save to Database
			$masterWilayah = new MasterWilayah();
			$masterWilayah->code = Input::get('code');
			$masterWilayah->name = Input::get('name');
			$masterWilayah->description = Input::get('description');
			$masterWilayah->parent_id = Input::get('parent_id');

			$level = 0;
			$masterWilayah->level = MasterWilayah::setWilayahLevelByParentId($masterWilayah->parent_id);
			if ($masterWilayah->parent_id > 0)
			{
				$parent = MasterWilayah::find($masterWilayah->parent_id);
				$level = (int) $parent->level + 1;
			}
			$masterWilayah->level = $level;

			$masterWilayah->save();

			// Redirect to List
			return Redirect::route('dashboard.masterdata.wilayah.index')->with([
				'messages' => ['Data berhasi disimpan']
			]);
		}

		return Redirect::route('dashboard.masterdata.wilayah.create')->with([
			'messages' => $messages
		]);

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
