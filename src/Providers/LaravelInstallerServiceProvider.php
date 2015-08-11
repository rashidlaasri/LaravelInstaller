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
        app('router')->middleware('isInstalled', '\RachidLaasri\LaravelInstaller\Middleware\IsInstalled');

        $this->loadTranslationsFrom(__DIR__.'/../Lang', 'LaravelInstaller');
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
            __DIR__.'/../views' => base_path('resources/views/installer'),
        ]);
    }
}