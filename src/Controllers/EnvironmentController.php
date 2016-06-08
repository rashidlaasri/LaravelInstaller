<?php

namespace Jaapgoorhuis\LaravelInstaller\Controllers;

use App, PDOException, error, pdo;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;
use Jaapgoorhuis\LaravelInstaller\Helpers\EnvironmentManager;

class EnvironmentController extends Controller
{

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
     * Display the Environment page.
     *
     * @return \Illuminate\View\View
     */
    public function environment()
    {
        $envConfig = $this->EnvironmentManager->getEnvContent();

        //Sets the default values of the .env file!

        $APP_ENV = 'local';
        $APP_DEBUG = 'true';
        $APP_KEY =  '4958763498756837942368weufgsdgw3';

        $DB_HOST = 'localhost';
        $DB_DATABASE = 'database';
        $DB_USERNAME = 'Username';
        $DB_PASSWORD = 'Password';
        
        $CACHE_DRIVER = 'file';
        $SESSION_DRIVER = 'file';
        $QUEUE_DRIVER = 'sync';

        $MAIL_DRIVER = 'smtp';
        $MAIL_HOST = 'mailtrap.io';
        $MAIL_PORT= 2525;
        $MAIL_USERNAME = 'null';
        $MAIL_PASSWORD = 'null';
        $MAIL_ENCRYPTION= 'null';


        return view('vendor.installer.environment', 
            [
                'APP_ENV' => $APP_ENV,
                'APP_DEBUG' => $APP_DEBUG,
                'APP_KEY' => $APP_KEY,
                'DB_HOST' => $DB_HOST,
                'DB_DATABASE' => $DB_DATABASE,
                'DB_USERNAME' => $DB_USERNAME,
                'DB_PASSWORD' => $DB_PASSWORD,
                'CACHE_DRIVER' => $CACHE_DRIVER,
                'SESSION_DRIVER' => $SESSION_DRIVER,
                'QUEUE_DRIVER' => $QUEUE_DRIVER,
                'MAIL_DRIVER' => $MAIL_DRIVER,
                'MAIL_HOST' => $MAIL_HOST,
                'MAIL_PORT' => $MAIL_PORT,
                'MAIL_USERNAME' => $MAIL_USERNAME,
                'MAIL_PASSWORD' => $MAIL_PASSWORD,
                'MAIL_ENCRYPTION' => $MAIL_ENCRYPTION,
            ]
        );
    }


    /**
     * Processes the newly saved environment configuration and redirects back.
     *
     * @param Request $input
     * @param Redirector $redirect
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $input, Redirector $redirect)
    {        
$file = "APP_ENV=".$input->APP_ENV."
APP_DEBUG=".$input->APP_DEBUG."
APP_KEY=".$input->APP_KEY."

DB_HOST=".$input->DB_HOST."
DB_DATABASE=".$input->DB_DATABASE."
DB_USERNAME=".$input->DB_USERNAME."
DB_PASSWORD=".$input->DB_PASSWORD."

CACHE_DRIVER=".$input->CACHE_DRIVER."
SESSION_DRIVER=".$input->SESSION_DRIVER."
QUEUE_DRIVER=".$input->QUEUE_DRIVER."

MAIL_DRIVER=".$input->MAIL_DRIVER."
MAIL_HOST=".$input->MAIL_HOST."
MAIL_PORT=".$input->MAIL_PORT."
MAIL_USERNAME=".$input->MAIL_USERNAME."
MAIL_PASSWORD=".$input->MAIL_PASSWORD."
MAIL_ENCRYPTION=".$input->MAIL_ENCRYPTION."
";

try{
    $dbh = new pdo( 'mysql:host='.$input->DB_HOST.':3306;dbname='.$input->DB_DATABASE,
                    $input->DB_USERNAME,
                    $input->DB_PASSWORD,
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $message = 'Successfully saved';
    $saved = true;

        $myfile = fopen("../.env", "w") or die("Unable to open file!");
        $txt = $file;
        fwrite($myfile, $txt);
        fclose($myfile);
}
catch(PDOException $ex){
    $message = 'Error unable to connect to database! ';
    $saved = false;
}

        

        return view('vendor.installer.environment', 
            [
                'saved' => $saved,
                'message' => $message,
                'APP_ENV' => $input->APP_ENV,
                'APP_DEBUG' => $input->APP_DEBUG,
                'APP_KEY' => $input->APP_KEY,
                'DB_HOST' => $input->DB_HOST,
                'DB_DATABASE' => $input->DB_DATABASE,
                'DB_USERNAME' => $input->DB_USERNAME,
                'DB_PASSWORD' => $input->DB_PASSWORD,
                'CACHE_DRIVER' => $input->CACHE_DRIVER,
                'SESSION_DRIVER' => $input->SESSION_DRIVER,
                'QUEUE_DRIVER' => $input->QUEUE_DRIVER,
                'MAIL_DRIVER' => $input->MAIL_DRIVER,
                'MAIL_HOST' => $input->MAIL_HOST,
                'MAIL_PORT' => $input->MAIL_PORT,
                'MAIL_USERNAME' => $input->MAIL_USERNAME,
                'MAIL_PASSWORD' => $input->MAIL_PASSWORD,
                'MAIL_ENCRYPTION' => $input->MAIL_ENCRYPTION,
            ]
        );
    }

}
