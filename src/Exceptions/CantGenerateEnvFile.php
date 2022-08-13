<?php

namespace RachidLaasri\LaravelInstaller\Exceptions;

use Exception;

class CantGenerateEnvFile extends Exception
{
    /**
     * Render the exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return view('installer::errors.cant-generate-env');
    }
}
