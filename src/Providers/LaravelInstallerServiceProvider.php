<?php

namespace RachidLaasri\LaravelInstaller\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use RachidLaasri\LaravelInstaller\Helpers\EnvironmentManager;
use RachidLaasri\LaravelInstaller\Middleware\canInstall;
use RachidLaasri\LaravelInstaller\Middleware\canUpdate;

class LaravelInstallerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @param $void
     */
    public function boot(Router $router)
    {
        if (empty(config('app.key'))) {
            $environment = new EnvironmentManager();
            $environment->generateEnvFile();
        }

        $router->middlewareGroup('install', [CanInstall::class]);
        $router->middlewareGroup('update', [CanUpdate::class]);
        $this->publishFiles();
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'installer');
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'installer');
    }

    /**
     * Publish config file for the installer.
     *
     * @return void
     */
    protected function publishFiles()
    {
        $this->publishes([
            __DIR__ . '/../Config/installer.php' => base_path('config/installer.php'),
        ], 'installer');

        $this->publishes([
            __DIR__ . '/../assets' => public_path('installer'),
        ], 'installer');

//        $this->publishes([
//            __DIR__.'/../Views' => base_path('resources/views/vendor/installer'),
//        ], 'installer');

//        $this->publishes([
//            __DIR__.'/../Lang' => base_path('resources/lang'),
//        ], 'installer');
    }
}
