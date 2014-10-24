<?php

class DashboardController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('dashboard.index');
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function showUserPermissions()
	{
		return View::make('dashboard.index');
	}
}
