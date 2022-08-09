<?php

namespace RachidLaasri\LaravelInstaller\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RachidLaasri\LaravelInstaller\Helpers\PermissionsChecker;
use RachidLaasri\LaravelInstaller\Helpers\RequirementsChecker;

class WelcomeController extends Controller
{

    protected $phpSupportInfo;
    protected $requirements;
    protected $permissions;

    /**
     * Display the installer welcome page.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        if (!$this->checkRequirements()) {
            return view('LaravelInstaller::requirements', [
                'phpSupportInfo' => $this->phpSupportInfo,
                'requirements' => $this->requirements,
            ]);
        };

        if (!$this->checkPermissions()) {
            return view('LaravelInstaller::permissions', ['permissions' => $this->permissions]);
        };

        return view('LaravelInstaller::environment-wizard');
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

}
