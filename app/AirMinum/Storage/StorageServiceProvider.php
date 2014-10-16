<?php namespace AirMinum\Storage;

use Illuminate\Support\ServiceProvider;

class StorageServiceProvider extends ServiceProvider {
	
	public function register()
	{
		$this->app->bind(
			'AirMinum\Storage\User\UserRepository',
			'AirMinum\Storage\User\EloquentUserRepository'
			);
	}
	
}