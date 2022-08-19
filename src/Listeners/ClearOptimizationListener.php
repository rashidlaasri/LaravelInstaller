<?php

namespace RachidLaasri\LaravelInstaller\Listeners;

use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;
use RachidLaasri\LaravelInstaller\Events\EnvironmentSaved;

class ClearOptimizationListener
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
     * @param object $event
     * @return void
     */
    public function handle(EnvironmentSaved $event)
    {
        try {
            Artisan::call('optimize:clear');
            Artisan::call('storage:link');
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([
                'message' => $exception->getMessage()
            ]);
        }
    }
}
