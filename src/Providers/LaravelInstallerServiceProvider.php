<?php

namespace RachidLaasri\LaravelInstaller\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use RachidLaasri\LaravelInstaller\Middleware\CanInstall;
use RachidLaasri\LaravelInstaller\Middleware\CanUpdate;

class LaravelInstallerServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->publishFiles();
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
    }

    /**
     * Bootstrap the application events.
     *
     * @param $void
     */
    public function boot(Router $router)
    {
        $router->middlewareGroup('install',[CanInstall::class]);
        $router->middlewareGroup('update',[CanUpdate::class]);
    }

    /**
     * Publish config file for the installer.
     *
     * @return void
     */
    protected function publishFiles()
    {
        $this->publishes([
            __DIR__.'/../../config/installer.php' => base_path('config/installer.php'),
        ], 'laravelinstaller');

        $this->publishes([
            __DIR__.'/../../resources/assets' => public_path('installer'),
        ], 'laravelinstaller');

        $this->publishes([
            __DIR__.'/../../resources/views' => base_path('resources/views/vendor/installer'),
        ], 'laravelinstaller');

        $this->publishes([
            __DIR__.'/../../resources/lang' => base_path('resources/lang'),
        ], 'laravelinstaller');
    }
}
