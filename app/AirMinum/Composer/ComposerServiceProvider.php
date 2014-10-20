<?php namespace AirMinum\Composer;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {
	
	public function register()
	{
		$this->app->view->composer('layouts.partials.sidemenu', 'AirMinum\Composer\AirMinumMenuComposer');
	}
}