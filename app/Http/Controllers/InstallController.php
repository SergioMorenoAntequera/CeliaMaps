<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class InstallController extends Controller
{
    public function index(){

        return view('install/formInstall');

    }

    public function createFile(Request $r){

        $host = $r->host;
        $appUrl = $r->appUrl;
        $dbConnection = $r->dbConnection;
        $dbPort = $r->dbPort;
        $namedb = $r->namedb;
        $userdb = $r->userdb;
        $passdb = Hash::make($r->passdb);

        $env = ".env3";

        $texto = "APP_URL=" . $appUrl . "\n
        DB_CONNECTION=" . $dbConnection . "\n
        DB_HOST=" . $host . "\n
        DB_PORT=" . $dbPort . "\n
        DB_DATABASE=" . $namedb . "\n
        DB_USERNAME=" . $userdb . "\n
        DB_PASSWORD=" . $passdb . "\n

        APP_NAME=CeliaMaps \n
        APP_ENV=local \n
        APP_KEY=base64:PS7qybVslICRb5b0KcM2Voeq4ywtHb8JjKQQxcLWup8= \n
        APP_DEBUG=true \n
        LOG_CHANNEL=stack \n

        MYSQLDUMP_PATH=D:/laragon/bin/mysql/mysql-5.7.24-winx64/bin/mysqldump.exe \n
        MYSQL_PATH=D:/laragon/bin/mysql/mysql-5.7.24-winx64/bin/mysql.exe \n
        BACKUP_PATH=D:/laragon/www/CeliaMaps/storage/celiamaps.sql \n

        BROADCAST_DRIVER=log \n
        CACHE_DRIVER=file \n
        QUEUE_CONNECTION=sync \n
        SESSION_DRIVER=file \n
        SESSION_LIFETIME=120 \n

        REDIS_HOST=127.0.0.1 \n
        REDIS_PASSWORD=null \n
        REDIS_PORT=6379 \n

        MAIL_DRIVER=smtp \n
        MAIL_HOST=smtp.mailtrap.io \n
        MAIL_PORT=2525 \n
        MAIL_USERNAME=null \n
        MAIL_PASSWORD=null \n
        MAIL_ENCRYPTION=null \n

        AWS_ACCESS_KEY_ID= \n
        AWS_SECRET_ACCESS_KEY= \n
        AWS_DEFAULT_REGION=us-east-1 \n
        AWS_BUCKET= \n

        PUSHER_APP_ID= \n
        PUSHER_APP_KEY= \n
        PUSHER_APP_SECRET= \n
        PUSHER_APP_CLUSTER=mt1 \n";

        //MIX_PUSHER_APP_KEY= '".$.{PUSHER_APP_KEY}."' \n
        //MIX_PUSHER_APP_CLUSTER='".$."{".PUSHER_APP_CLUSTER."}' \n";


        if($archivo = fopen($env,"w")){
            fwrite($archivo, $texto);
        }else {
            //mostrar mensaje para que se haga a mano.
        }

        fclose($archivo);

        $old = public_path('.env3');

        $new = "/.env3";

        rename(".env3", "../.env3");
        //unlink('.env3'); NO ES NECESARIO PORQUE CON rename LO MUEVE
        //unlink("views/install/formInstall.blade.php"); PARA BORRAR LOS ARCHIVOS DE INSTALACIÓN
    }

    public function migration(){

        Artisan::call('migrate --fresh');


    }
    public function createUser(Request $r){
        // sin terminar
        $username = $r->name;
        $password = Hash::make($r->password);
        $email = $r->email;

    }

}

