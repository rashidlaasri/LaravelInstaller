<?php

namespace RachidLaasri\LaravelInstaller\Providers;

use Illuminate\Support\ServiceProvider;

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

        include __DIR__ . '/../routes.php';
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        app('router')->middleware('canInstall', '\RachidLaasri\LaravelInstaller\Middleware\canInstall');
    }

    /**
     * Publish config file for the installer.
     *
     * @return void
     */
    protected function publishFiles()
    {
        $this->publishes([
            __DIR__.'/../Config/installer.php' => base_path('config/installer.php'),
        ]);

        $this->publishes([
            __DIR__.'/../assets' => public_path('installer'),
        ], 'public');

        $this->publishes([
            __DIR__.'/../Views' => base_path('resources/views/vendor/installer'),
        ]);

        $this->publishes([
            __DIR__.'/../Lang' => base_path('resources/lang'),
        ]);
    }
}