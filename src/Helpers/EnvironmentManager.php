<?php

namespace RachidLaasri\LaravelInstaller\Helpers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Encryption\Encrypter;

class EnvironmentManager
{
    /**
     * @var string
     */
    private $envPath;

    /**
     * @var string
     */
    private $envExamplePath;

    /**
     * Set the .env and .env.example paths.
     */
    public function __construct()
    {
        $this->envPath = base_path('.env');
        $this->envExamplePath = base_path('.env.example');
    }

    /**
     * Get the content of the .env file.
     *
     * @return string
     */
    public function getEnvContent()
    {
        if (!file_exists($this->envPath)) {
            if (file_exists($this->envExamplePath)) {
                copy($this->envExamplePath, $this->envPath);
            } else {
                touch($this->envPath);
            }
        }

        return file_get_contents($this->envPath);
    }

    /**
     * Get the the .env file path.
     *
     * @return string
     */
    public function getEnvPath() {
        return $this->envPath;
    }

    /**
     * Get the the .env.example file path.
     *
     * @return string
     */
    public function getEnvExamplePath() {
        return $this->envExamplePath;
    }

    /**
     * Save the edited content to the .env file.
     *
     * @param Request $input
     * @return string
     */
    public function saveFileClassic(Request $input)
    {
        $message = trans('installer_messages.environment.success');

        try {
            file_put_contents($this->envPath, $input->get('envConfig'));
        }
        catch(Exception $e) {
            $message = trans('installer_messages.environment.errors');
        }

        return $message;
    }


    /**
     * @param $data
     * @return string
     */
    public function setEnvironmentValue($data)
    {
        $env_file = app()->environmentFilePath();
        $string = file_get_contents($env_file);
        foreach ($data as $key => $item) {
            preg_match("/{$key}=(.*?)[\r\n|\r|\n]/", $string, $matches);
            if (array_key_exists(1, $matches)) {
                $current_value = $matches[1];
                $string = str_replace("{$key}={$current_value}", "{$key}={$item}", $string);
            }
        }

        return $string;
    }

    /**
     * Save the form content to the .env file.
     *
     * @param Request $request
     * @return string
     */
    public function saveFileWizard(Request $request)
    {
        $results = trans('installer_messages.environment.success');

        $key = 'base64:'.base64_encode(
                Encrypter::generateKey(config('config.app.ciphers'))
            );

        $data = [
            'APP_NAME' => $request->app_name,
            'APP_ENV' => $request->environment,
            'APP_KEY' => $key,
            'APP_DEBUG' => $request->app_debug,
            'APP_LOG_LEVEL' => $request->app_log_level,
            'APP_URL' => $request->app_url,
            'DB_CONNECTION' => $request->database_connection,
            'DB_HOST' => $request->database_hostname,
            'DB_PORT' => $request->database_port,
            'DB_DATABASE' => $request->database_name,
            'DB_USERNAME' => $request->database_username,
            'DB_PASSWORD' => $request->database_password,
            'BROADCAST_DRIVER' => $request->broadcast_driver,
            'CACHE_DRIVER' => $request->cache_driver,
            'SESSION_DRIVER' => $request->session_driver,
            'QUEUE_DRIVER' => $request->queue_driver,
            'REDIS_HOST' => $request->redis_hostname,
            'REDIS_PASSWORD' => $request->redis_password,
            'REDIS_PORT' => $request->redis_port,
            'MAIL_DRIVER' => $request->mail_driver,
            'MAIL_HOST' => $request->mail_host,
            'MAIL_PORT' => $request->mail_port,
            'MAIL_USERNAME' => $request->mail_username,
            'MAIL_PASSWORD' => $request->mail_password,
            'MAIL_ENCRYPTION' => $request->mail_encryption,
            'PUSHER_APP_ID' => $request->pusher_app_id,
            'PUSHER_APP_KEY' => $request->pusher_app_key,
            'PUSHER_APP_SECRET' => $request->pusher_app_secret
        ];

        try {
            file_put_contents($this->envPath, $this->setEnvironmentValue($data));

        }
        catch(Exception $e) {
            $results = trans('installer_messages.environment.errors');
        }

        return $results;
    }
}
