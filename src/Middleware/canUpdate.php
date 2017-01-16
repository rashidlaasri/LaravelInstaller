<?php

namespace RachidLaasri\LaravelInstaller\Middleware;

use Closure;
use DB;
use RachidLaasri\LaravelInstaller\Middleware\canInstall;

class canUpdate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $canInstall = new canInstall;

        // if the application has not been installed,
        // redirect to the installer
        if (!$canInstall->alreadyInstalled()) {
            return redirect()->route('LaravelInstaller::welcome');
        }

        if($this->alreadyUpdated()) {
            abort(404);
        }

        return $next($request);
    }

    /**
     * If application is already updated.
     *
     * @return bool
     */
    public function alreadyUpdated()
    {
        // todo
        return false;
    }
}
