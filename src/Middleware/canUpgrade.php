<?php

namespace RachidLaasri\LaravelInstaller\Middleware;

use Closure;

class canUpgrade
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
        if($this->notInstalled()) {
            return redirect()->route('LaravelInstaller::install');
        }

        if($this->upToDate()) {
            return redirect('/');
        }
        
        return $next($request);
    }

    /**
     * Check if the application is not installed.
     *
     * @return bool
     */
    public function notInstalled()
    {
        return ! file_exists(storage_path('installed'));
    }

    /**
     * Check if an update is available.
     *
     * @return bool
     */
    public function upToDate()
    {
        return file_get_contents(storage_path('installed')) >= config('installer.last_version');
    }
}
