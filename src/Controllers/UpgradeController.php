<?php

namespace RachidLaasri\LaravelInstaller\Controllers;

use App\Http\Controllers\Controller;
use RachidLaasri\LaravelInstaller\Helpers\UpgradeManager;

class UpgradeController extends Controller
{
    /**
     * Display upgrade welcome page.
     *
     * @return \Illuminate\View\View
     */
    public function welcome()
    {
        $currentVersion = $this->getCurrentVersion();

        return view('vendor.installer.upgradeWelcome', compact('currentVersion'));
    }

    /**
     * Update database and seed tables.
     *
     * @param UpgradeManager $manager
     * @return \Illuminate\Http\RedirectResponse
     */
    public function process(UpgradeManager $manager)
    {
        $response = $manager->updateDatabaseAndSeedTables();

        return redirect()->route('LaravelInstaller::final')
                         ->with(['message' => $response]);
    }

    /**
     * Get current installed version.
     *
     * @return string
     */
    private function getCurrentVersion()
    {
        return file_get_contents(storage_path('installed'));
    }

}