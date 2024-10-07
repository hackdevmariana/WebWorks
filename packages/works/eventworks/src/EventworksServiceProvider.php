<?php

namespace Works\Eventworks;

use Illuminate\Support\ServiceProvider;

class EventworksServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Cargar las migraciones
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
    }

    public function register()
    {
        //
    }
}
