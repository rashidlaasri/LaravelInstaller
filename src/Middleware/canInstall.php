<?php

namespace RachidLaasri\LaravelInstaller\Middleware;

use Closure;
use Redirect;
use RachidLaasri\LaravelInstaller\Helpers\InstalledFileManager;

class canInstall
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        $installerEnabled = filter_var(config('installer.installerEnabled', true), FILTER_VALIDATE_BOOLEAN);
        $ignoreAlreadyInstalled = filter_var(config('installer.ignoreAlreadyInstalled', false), FILTER_VALIDATE_BOOLEAN);

        if(!$ignoreAlreadyInstalled) {
            if (InstalledFileManager::alreadyInstalled() || !$installerEnabled) {
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
        }

        return $next($request);
    }
}
