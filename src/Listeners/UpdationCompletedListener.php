<?php

namespace RachidLaasri\LaravelInstaller\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;
use Laracasts\Flash\Flash;
use RachidLaasri\LaravelInstaller\Events\LaravelInstallerUpdated;

class UpdationCompletedListener
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
    public function handle(LaravelInstallerUpdated $event)
    {
            request()->session()->forget('update_status');
            request()->session()->forget('isUpToDate');

            Flash::success('ChargePanda has been successfully updated.');
            return redirect()->route('ch-admin.ch_admin_dashboard', ['update_check' => true]);
    }
}
