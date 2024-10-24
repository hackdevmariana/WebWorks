<?php

namespace Works\Webworks\Providers;

use Illuminate\Support\ServiceProvider;

class WebworksServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Registrar las configuraciones del paquete
        $this->mergeConfigFrom(__DIR__.'/../Config/webworks.php', 'webworks');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Cargar rutas
        //$this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/../Routes/api.php');  // <---- Añadir esta línea


        // Cargar migraciones
        $this->loadMigrationsFrom(__DIR__.'/../Migrations');

        // Cargar vistas, si tienes vistas en tu paquete
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'webworks');

        // Cargar traducciones, si tienes archivos de traducción en tu paquete
        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'webworks');

        // Publicar recursos opcionales como vistas y migraciones


        $this->publishes([
            __DIR__.'/../Resources/views' => resource_path('views/vendor/webworks'),
        ], 'views');

        $this->publishes([
            __DIR__.'/../Resources/lang' => resource_path('lang/vendor/webworks'),
        ], 'lang');

        $this->publishes([
            __DIR__.'/../Migrations/' => database_path('migrations'),
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../Seeders/WebsiteSeeder.php' => database_path('seeders/WebsiteSeeder.php'),
        ], 'seeders');

        $this->publishes([
            __DIR__.'/../Seeders/ErrorPageSeeder.php' => database_path('seeders/ErrorPageSeeder.php'),
        ], 'seeders');

        $this->publishes([
            __DIR__.'/../Seeders/SectionHeadingSeeder.php' => database_path('seeders/SectionHeadingSeeder.php'),
        ], 'seeders');
        $this->publishes([
            __DIR__.'/../Seeders/SocialNetworkSeeder.php' => database_path('seeders/SocialNetworkSeeder.php'),
        ], 'seeders');

        $this->publishes([
            __DIR__.'/../Seeders/ContactSeeder.php' => database_path('seeders/ContactSeeder.php'),
        ], 'seeders');

        $this->publishes([
            __DIR__.'/../Seeders/DevelopedSeeder.php' => database_path('seeders/DevelopedSeeder.php'),
        ], 'seeders');
    }

}

