<?php

namespace RachidLaasri\LaravelInstaller\Helpers;


class InstalledFileManager
{
    /**
     * Create installed file.
     *
     * @param $message
     * @return int
     */
    public function create($message)
    {
        file_put_contents(storage_path('installed'), $message);
    }

    /**
     * Update installed file.
     *
     * @param $message
     * @return int
     */
    public function update($message)
    {
        return $this->create($message);
    }
}