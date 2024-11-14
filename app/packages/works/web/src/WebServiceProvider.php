<?php

namespace Works\Web;

use Illuminate\Support\ServiceProvider;

class WebServiceProvider extends ServiceProvider
{
	public function register()
	{
		// Register package services or bindings
	}

	public function boot()
	{
		// Register package migrations, seeders, routes, etc.
		if ($this->app->runningInConsole()) {
			// Load package migrations
			$this->loadMigrationsFrom(__DIR__ . '/Migrations');

			// Publish seeders
			$this->publishes([
				__DIR__ . '/Seeders/WebSeeder.php' => database_path('seeders/WebSeeder.php'),
			], 'seeders');
		}

		// Load package routes if you have them
		// $this->loadRoutesFrom(__DIR__ . '/Routes/web.php');
		$this->loadRoutesFrom(__DIR__ . '/Routes/api.php');

	}
}
