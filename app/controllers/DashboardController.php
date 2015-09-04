<?php

class DashboardController extends \BaseController {

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function __construct ()
	{
		self::$pageinfo = ['menu'=>['dashboard']];
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('pages.dashboard')->with('pageinfo', self::$pageinfo);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function showUserPermissions()
	{
		return View::make('pages.dashboard')->with('pageinfo', self::$pageinfo);
	}
}
