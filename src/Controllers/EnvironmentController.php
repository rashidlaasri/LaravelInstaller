<?php

namespace RachidLaasri\LaravelInstaller\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Artisan;
use RachidLaasri\LaravelInstaller\Helpers\EnvironmentManager;
use RachidLaasri\LaravelInstaller\Events\EnvironmentSaved;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EnvironmentController extends Controller
{
    /**
     * @var EnvironmentManager
     */
    protected $EnvironmentManager;

    /**
     * @param EnvironmentManager $environmentManager
     */
    public function __construct(EnvironmentManager $environmentManager)
    {
        $this->EnvironmentManager = $environmentManager;
    }

    /**
     * Display the Environment menu page.
     *
     * @return \Illuminate\View\View
     */
    public function environmentMenu()
    {
        return view('vendor.installer.environment');
    }

    /**
     * Display the Environment page.
     *
     * @return \Illuminate\View\View
     */
    public function environmentWizard()
    {
        $envConfig = $this->EnvironmentManager->getEnvContent();

        return view('vendor.installer.environment-wizard', compact('envConfig'));
    }

    /**
     * Display the Environment page.
     *
     * @return \Illuminate\View\View
     */
    public function environmentClassic()
    {
        $envConfig = $this->EnvironmentManager->getEnvContent();

        return view('vendor.installer.environment-classic', compact('envConfig'));
    }

    /**
     * Processes the newly saved environment configuration (Classic).
     *
     * @param Request $input
     * @param Redirector $redirect
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveClassic(Request $input, Redirector $redirect)
    {
        $message = $this->EnvironmentManager->saveFileClassic($input);

        event(new EnvironmentSaved($input));

        return $redirect->route('LaravelInstaller::environmentClassic')
                        ->with(['message' => $message]);
    }

    /**
     * Processes the newly saved environment configuration (Form Wizard).
     *
     * @param Request $request
     * @param Redirector $redirect
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveWizard(Request $request, Redirector $redirect)
    {
        $rules = config('installer.environment.form.rules');
        $messages = [
            'environment_custom.required_if' => trans('installer_messages.environment.wizard.form.name_required'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        $testConnection = Str::random(5);

        $validator->after(function ($validator) use ($request, $testConnection){
            try {
                $cloneDbConfig = \config('database.connections.'.$request->input('database_connection'));

                $cloneDbConfig["host"] = $request->input('database_hostname');
                $cloneDbConfig["port"] = $request->input('database_port');
                $cloneDbConfig["database"] = $request->input('database_name');
                $cloneDbConfig["username"] = $request->input('database_username');
                $cloneDbConfig["password"] = $request->input('database_password');

                Config::set('database.connections.'.$testConnection, $cloneDbConfig);
            } catch (\Exception $exception) {
                dd($exception->getMessage());
            }

            $dbConnected = false;

            try {
                DB::connection($testConnection)->getPdo();

                $dbConnected = true;
            } catch (\Exception $e) {
                $request->session()->flash('tab', 'db');
                $dbConnected = false;

                $validator->errors()->add('database_connection', 'Database credentials are not correct.');
            }

            if ($dbConnected == true) {
                $tables = DB::connection($testConnection)->select('SHOW TABLES');

                if (sizeof($tables) > 0) {
                    $request->session()->flash('tab', 'db');
                    $validator->errors()->add('database_connection', 'Database is not empty. Please provide empty database credentials.');
                }
            }
        });

        if ($validator->fails()) {
            $errors = $validator->errors();
            return view('vendor.installer.environment-wizard', compact('errors', 'envConfig'));
        }

        $results = $this->EnvironmentManager->saveFileWizard($request);

        event(new EnvironmentSaved($request));

        return $redirect->route('LaravelInstaller::database')
                        ->with(['results' => $results]);
    }
}
