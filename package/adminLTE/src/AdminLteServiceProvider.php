<?php


namespace MrjavadSeydi\AdminLTE;

use Illuminate\Support\ServiceProvider;

class AdminLteServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../route/web.php');
        $this->loadViewsFrom(__DIR__."/../resource/view",'adminLTE');
        $this->loadMigrationsFrom(__DIR__ . "/Migrations");
        $this->publishes([
            __DIR__."/../resource/public" => public_path('/'),
            __DIR__."/../resource/view" => resource_path('/views/adminLTE')
        ]);

    }
    public function register()
    {

    }

}
