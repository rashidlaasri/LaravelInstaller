<?php

namespace RachidLaasri\LaravelInstaller\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;
use Laracasts\Flash\Flash;
use App\Models\User;
use RachidLaasri\LaravelInstaller\Controllers\InstallationSuccessfulNotification;
use RachidLaasri\LaravelInstaller\Events\LaravelInstallerFinished;

class InstallationFinishedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(LaravelInstallerFinished $event)
    {
        Artisan::call('optimize:clear');
    }
}
