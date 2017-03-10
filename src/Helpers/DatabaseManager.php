<?php

namespace RachidLaasri\LaravelInstaller\Helpers;

use Exception;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class DatabaseManager
{

    /**
     * Custom Commands
     *
     * @return array
     */
    public function commands()
    {
        if(is_array(Config::get('installer.commands'))) {

            try{
                foreach (Config::get('installer.commands') as $command){

                    Artisan::call($command , ["--force"=> true ]);
                }
            }
            catch(Exception $e){
                return $this->response($e->getMessage());
            }
        }

        return $this->response(trans('messages.final.finished'), 'success');
    }

    /**
     * Return a formatted error messages.
     *
     * @param $message
     * @param string $status
     * @return array
     */
    private function response($message, $status = 'danger')
    {
        return array(
            'status' => $status,
            'message' => $message
        );
    }
    
        /**
     * check database type. If SQLite, then create the database file.
     */
    private function sqlite()
    {
        if(DB::connection() instanceof SQLiteConnection) {
            $database = DB::connection()->getDatabaseName();
            if(!file_exists($database)) {
                touch($database);
                DB::reconnect(Config::get('database.default'));
            }
        }
    }
}
