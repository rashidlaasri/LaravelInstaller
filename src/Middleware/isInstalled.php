<?php

namespace RachidLaasri\LaravelInstaller\Middleware;

use Closure;
use DB;

class isInstalled
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
        $tables = DB::select('SHOW TABLES');

        if(!empty($tables)) {

            abort(404);
        }
        
        return $next($request);
    }
}
