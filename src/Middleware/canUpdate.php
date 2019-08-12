<?php

namespace RachidLaasri\LaravelInstaller\Middleware;

use Closure;

class canUpdate
{
    use \RachidLaasri\LaravelInstaller\Helpers\MigrationsHelper;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $updateEnabled = filter_var(config('installer.updaterEnabled'), FILTER_VALIDATE_BOOLEAN);

        if ($updateEnabled === false || $this->alreadyUpdated()) {
            abort(404);
        }

        if (! (new canInstall)->alreadyInstalled()) {
            return redirect()->route('LaravelInstaller::welcome');
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
        $migrations = $this->getMigrations();
        $dbMigrations = $this->getExecutedMigrations();

        // If the count of migrations and dbMigrations is equal,
        // then the update as already been updated.
        return count($migrations) == count($dbMigrations);
    }
}
