<?php

namespace App\Http\Middleware;

use Closure, Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class Installation
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
        if(!file_exists(storage_path('installed'))){
            return redirect('install');
            die();
        }else{
            return $next($request);
        }
    }
}
