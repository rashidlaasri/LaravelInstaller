<?php

namespace RachidLaasri\LaravelInstaller\Middleware;

use Closure;
use DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Schema;
use Redirect;

class canInstall
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param Redirector $redirect
     * @return mixed
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if ($this->alreadyInstalled()) {

            $installedRedirect = config('installer.installedAlreadyAction');

            switch ($installedRedirect) {

                case 'route':
                    $routeName = config('installer.installed.redirectOptions.route.name');
                    $data = config('installer.installed.redirectOptions.route.message');
                    return redirect()->route($routeName)->with(['data' => $data]);
                    break;

                case 'abort':
                    abort(config('installer.installed.redirectOptions.abort.type'));
                    break;

                case 'dump':
                    $dump = config('installer.installed.redirectOptions.dump.data');
                    dd($dump);
                    break;

                case '404':
                case 'default':
                default:
                    abort(404);
                    break;
            }
        }
        return $next($request);
    }

    /**
     * If application is already installed.
     *
     * @return bool
     */
    public function alreadyInstalled()
    {
        return false;
        try {
            return Schema::hasTable('settings');
        } catch (QueryException $exception) {
            return false;
        }
    }
}
