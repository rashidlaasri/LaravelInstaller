<?php

namespace RachidLaasri\LaravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use RachidLaasri\LaravelInstaller\Helpers\DatabaseManager;
use RachidLaasri\LaravelInstaller\Helpers\InstalledFileManager;

class UpdateController extends Controller
{
    use \RachidLaasri\LaravelInstaller\Helpers\MigrationsHelper;

    /**
     * Display the updater welcome page.
     *
     * @return \Illuminate\View\View
     */
    public function welcome()
    {
        try {
            \Illuminate\Support\Facades\Artisan::call('config:clear');
            \Illuminate\Support\Facades\Artisan::call('cache:clear');
            \Illuminate\Support\Facades\Artisan::call('view:clear');
        } catch (\Exception $exception) { }

        return view('LaravelInstaller::update.welcome');
    }

    /**
     * Display the updater overview page.
     *
     * @return \Illuminate\View\View
     */
    public function overview()
    {
        $migrations = $this->getMigrations();
        $dbMigrations = $this->getExecutedMigrations();

        return view('LaravelInstaller::update.overview', ['numberOfUpdatesPending' => count($migrations) - count($dbMigrations)]);
    }

    /**
     * Migrate and seed the database.
     *
     * @return \Illuminate\View\View
     */
    public function database()
    {
        $databaseManager = new DatabaseManager;
        $response = $databaseManager->migrateAndSeed();

        return redirect()->route('LaravelUpdater::final')
                         ->with(['message' => $response]);
    }

    /**
     * Update installed file and display finished view.
     *
     * @param InstalledFileManager $fileManager
     * @return \Illuminate\View\View
     */
    public function finish(InstalledFileManager $fileManager)
    {
        $fileManager->update();

        $this->updateHtaccess();

        try {
            \Illuminate\Support\Facades\Artisan::call('config:clear');
            \Illuminate\Support\Facades\Artisan::call('cache:clear');
            \Illuminate\Support\Facades\Artisan::call('view:clear');
        } catch (\Exception $exception) { }

        return view('LaravelInstaller::update.finished');
    }

    protected function updateHtaccess()
    {
        $segments = array_filter(explode('/', \request()->getRequestUri()), 'strlen');

        try {
            if ( isset($segments[0]) && $segments[0] == 'update' ) {
                // root directory
            } else {
                // sub directory
                $htaccess = file_get_contents(base_path('.htaccess'));

                $request_uri = \request()->getRequestUri();

                $pos = strpos($request_uri, 'update');

                $path = substr($request_uri, 0, $pos);

                $htaccess = str_replace(
                    'RewriteRule ^storage/uploads/(.*) /storage/app/public/uploads/$1 [L]',
                    'RewriteRule ^storage/uploads/(.*) '.$path.'storage/app/public/uploads/$1 [L]',
                    $htaccess
                );

                file_put_contents(base_path('.htaccess'), $htaccess);
            }

        }
        catch(Exception $e) { }
    }
}
