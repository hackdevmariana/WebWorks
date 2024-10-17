<?php

namespace Works\Quoteworks;

use Illuminate\Support\ServiceProvider;

class QuoteWorksServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // 
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Cargar las migraciones
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        $this->loadRoutesFrom(__DIR__.'/Routes/api.php');

    }
}