<?php

namespace RachidLaasri\LaravelInstaller\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use RachidLaasri\LaravelInstaller\Events\EnvironmentSaved;
use RachidLaasri\LaravelInstaller\Helpers\DatabaseManager;
use RachidLaasri\LaravelInstaller\Helpers\EnvironmentManager;
use RachidLaasri\LaravelInstaller\Helpers\FinalInstallManager;
use RachidLaasri\LaravelInstaller\Helpers\PermissionsChecker;
use RachidLaasri\LaravelInstaller\Helpers\RequirementsChecker;
use Validator;

class WelcomeController extends Controller
{

    protected $phpSupportInfo;
    protected $requirements;
    protected $permissions;

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
     * Display the installer welcome page.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        if (!$this->checkRequirements()) {
            return view('installer::requirements', [
                'phpSupportInfo' => $this->phpSupportInfo,
                'requirements' => $this->requirements,
            ]);
        };

        if (!$this->checkPermissions()) {
            return view('installer::permissions', ['permissions' => $this->permissions]);
        };

        return view('installer::welcome');
    }

    public function checkRequirements()
    {
        $checker = new RequirementsChecker();

        $this->phpSupportInfo = $checker->checkPHPversion(
            config('installer.core.minPhpVersion')
        );

        $this->requirements = $checker->check(
            config('installer.requirements')
        );

        if (isset($this->requirements['errors']) || !$this->phpSupportInfo['supported']) {
            return false;
        }

        return true;
    }

    public function checkPermissions()
    {
        $checker = new PermissionsChecker();

        $this->permissions = $checker->check(
            config('installer.permissions')
        );

        if (isset($this->permissions['errors'])) {
            return false;
        }

        return true;
    }

    /**
     * Processes the newly saved environment configuration (Form Wizard).
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function install(Request $request)
    {
        $rules = config('installer.environment.form.rules');

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $errors = $validator->errors();

            return redirect('/install')->withInput()->withErrors($errors);
        }

        $this->createEnvFile($request);

        $databaseManager = new DatabaseManager();

        $databaseManager->migrateAndSeed();

        $admin_role = Role::where('name', 'administrator')->first();

        $admin = new User([
            'username' => 'admin',
            'email' => $request->admin_email,
            'password' => bcrypt($request->admin_password),
        ]);

        $admin->email_verified_at = now();

        $admin->save();

        $admin->roles()->attach($admin_role);

        return view('installer::finished', compact('admin'));
    }

    public function createEnvFile($request)
    {
        $testConnection = Str::random(5);

        try {
            $cloneDbConfig = \config('database.connections.mysql');

            $cloneDbConfig["host"] = $request->input('database_hostname');
            $cloneDbConfig["port"] = $request->input('database_port');
            $cloneDbConfig["database"] = $request->input('database_name');
            $cloneDbConfig["username"] = $request->input('database_username');
            $cloneDbConfig["password"] = $request->input('database_password');

            Config::set('database.connections.' . $testConnection, $cloneDbConfig);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([
                'message' => $exception->getMessage()
            ]);
        }

        $dbConnected = false;

        try {
            DB::connection($testConnection)->getPdo();

            $dbConnected = true;
        } catch (\Exception $e) {
            $dbConnected = false;
            throw ValidationException::withMessages([
                'message' => 'Database credentials are not correct.'
            ]);
        }

        if ($dbConnected == true) {
            $tables = DB::connection($testConnection)->select('SHOW TABLES');
            if (sizeof($tables) > 0) {
                throw ValidationException::withMessages([
                    'message' => 'Database is not empty. Please provide empty database credentials.'
                ]);
            }
        }

        $this->EnvironmentManager->saveFileWizard($request);

        event(new EnvironmentSaved($request));
    }
}
