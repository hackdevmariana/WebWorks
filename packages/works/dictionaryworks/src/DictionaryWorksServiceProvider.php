<?php

namespace Works\Dictionaryworks;



use Illuminate\Support\ServiceProvider;

class DictionaryWorksServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Código de registro de servicios
    }

    public function boot()
    {
        // Cargar las migraciones
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        $this->loadRoutesFrom(__DIR__.'/Routes/api.php');

    }
}

