<?php

namespace RachidLaasri\LaravelInstaller\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class EnvironmentController extends Controller
{

    private $envPath, $envExamplePath;

    public function __construct()
    {
        $this->envPath = base_path('.env');
        $this->envExamplePath = base_path('.env.example');
    }

    /**
     * Display the Environment page.
     *
     * @return \Illuminate\View\View
     */
    public function environment()
    {
        if (!file_exists($this->envPath)) {
            if (file_exists($this->envExamplePath)) {
                copy($this->envExamplePath, $this->envPath);
            } else {
                touch($this->envPath);
            }
        }

        $envConfig = file_get_contents($this->envPath);

        return view('vendor.installer.environment', compact('envConfig'));
    }


    /**
     * Processes the newly saved environment configuration and redirects back.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $input, Redirector $redirect)
    {
        file_put_contents($this->envPath, $input->get('envConfig'));
        return $redirect->route('LaravelInstaller::environment');
    }

}
