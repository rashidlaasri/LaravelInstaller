<?php

namespace RachidLaasri\LaravelInstaller\Helpers;


class InstalledFileManager
{
    /**
     * Create installed file.
     *
     * @return int
     */
    public function create()
    {
        file_put_contents(storage_path('installed'), '');

        $result = file_get_contents(base_path('.env'));
        $newLine = "APP_ENV=staging\nSESSION_DRIVER=database\n";
        fwrite($result, $newLine);
    }

    /**
     * Update installed file.
     *
     * @return int
     */
    public function update()
    {
        return $this->create();
    }
}