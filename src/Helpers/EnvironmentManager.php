<?php

namespace RachidLaasri\LaravelInstaller\Helpers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    public function generateEnvFile()
    {
        if (!file_exists($this->envPath)) {
            if (file_exists($this->envExamplePath)) {
                copy($this->envExamplePath, $this->envPath);
            }
        }
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
    public function getEnvPath()
    {
        return $this->envPath;
    }

    /**
     * Get the the .env.example file path.
     *
     * @return string
     */
    public function getEnvExamplePath()
    {
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
        $message = trans('installer::installer_messages.environment.success');

        try {
            file_put_contents($this->envPath, $input->get('envConfig'));
        } catch (Exception $e) {
            $message = trans('installer::installer_messages.environment.errors');
        }

        return $message;
    }

    /**
     * Save the form content to the .env file.
     *
     * @param Request $request
     * @return string
     */
    public function saveFileWizard(Request $request)
    {
        $message = trans('installer::installer_messages.environment.success');
        $status = 'success';

        $envFileData =
            'APP_NAME=\'' . $request->app_name . "'\n" .
            'APP_ENV=' . config('app.env', 'production') . "\n" .
            'APP_KEY=base64:' . base64_encode(Str::random(32)) . "\n" .
            'APP_DEBUG=' . config('app.debug', false) . "\n" .
            'APP_URL=' . $request->app_url . "\n\n" .

            'LOG_CHANNEL=stack' . "\n" .
            'LOG_DEPRECATIONS_CHANNEL=null' . "\n" .
            'LOG_LEVEL=debug' . "\n\n" .

            'DB_CONNECTION=mysql' . "\n" .
            'DB_HOST=' . $request->database_hostname . "\n" .
            'DB_PORT=' . $request->database_port . "\n" .
            'DB_DATABASE=' . $request->database_name . "\n" .
            'DB_USERNAME=' . $request->database_username . "\n" .
            'DB_PASSWORD=' . $request->database_password . "\n\n" .

            '
BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=sendmail
#MAIL_HOST=smtp.mailtrap.io
#AIL_PORT=2525
#MAIL_USERNAME=null
#MAIL_PASSWORD=null
#MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="' . $request->admin_email . '"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
';

        try {
            file_put_contents($this->envPath, $envFileData);
        } catch (Exception $e) {
            $status = 'error';
            $message = trans('installer::installer_messages.environment.errors');
        }

        try {
            $segments = array_filter(explode('/', \request()->getRequestUri()), 'strlen');
            if (isset($segments[0]) && $segments[0] == 'install') {
                // root directory
            } else {
                // sub directory
                $htaccess = file_get_contents(base_path('public\.htaccess'));

                $request_uri = \request()->getRequestUri();

                $pos = strpos($request_uri, 'install');

                $path = substr($request_uri, 0, $pos);

                $htaccess = str_replace(
                    'RewriteRule ^storage/uploads/(.*) /storage/app/public/uploads/$1 [L]',
                    'RewriteRule ^storage/uploads/(.*) ' . $path . 'storage/app/public/uploads/$1 [L]',
                    $htaccess
                );

                file_put_contents(base_path('public\.htaccess'), $htaccess);
            }
        } catch (Exception $e) {
            $status = 'error';
            $message = trans('installer::installer_messages.environment.htaccess_errors');
        }

        return [
            'status' => $status,
            'message' => $message,
        ];
    }
}
