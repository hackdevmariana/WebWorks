<?php

namespace Works\Web;

use Illuminate\Support\ServiceProvider;

class WebServiceProvider extends ServiceProvider
{
	public function register()
	{
		// Register package services
	}

	public function boot()
	{
		// Register package routes, migrations, etc.
		if ($this->app->runningInConsole()) {
			$this->loadMigrationsFrom(__DIR__.'/Migrations');
		}
	}
}
