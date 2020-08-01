<?php

namespace RachidLaasri\LaravelInstaller\Helpers;

use Exception;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\BufferedOutput;

class CommandManager
{
    /**
     * Migrate and seed the database.
     *
     * @return array
     */
    public function executeCommands()
    {
        $outputLog = new BufferedOutput;
        $commands = config('installer.commands');
        $response = [];

        if (is_array($commands) && count($commands) > 0){
            foreach ($commands as $command) {
                array_push($response, $this->execute($command, $outputLog));
            }
        }
        return $response;
    }

    /**
     * Run the command and add response.
     *
     * @param \Symfony\Component\Console\Output\BufferedOutput $outputLog
     * @return array
     */
    private function execute($command, BufferedOutput $outputLog)
    {
        try {
            Artisan::call($command, [], $outputLog);
        } catch (Exception $e) {
            return $this->response($command, $e->getMessage(), 'error', $outputLog);
        }

        return $this->response($command, "Success", 'success', $outputLog);
    }

    /**
     * Return a formatted error messages.
     *
     * @param string $message
     * @param string $status
     * @param \Symfony\Component\Console\Output\BufferedOutput $outputLog
     * @return array
     */
    private function response($command, $message, $status, BufferedOutput $outputLog)
    {
        return [
            'command' => $command,
            'status' => $status,
            'message' => $message,
            'outputLog' => $outputLog->fetch(),
        ];
    }

}
