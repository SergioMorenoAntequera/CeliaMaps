<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Artisan;
use DB;
use App\console\Commands;
use App\User;

class InstallController extends Controller
{
    public function index(){
        /*Comprobamos que el proceso de instalación no se ha completado anteriormente.
        Es posible que las tablas existan porque se han hecho las migraciones, pero
        se ha podido interrumpir el proceso, así que hay que comprobar si existe la tabla user o
        si existe algún usuario. Hay que encerrarlo en un try catch porque User::exists() es igual
        que select * from user, y si la tabla no existe da un error.
        */
        try{
            //COMPRUEBA SI EXISTE TABLA Y SI HAY USUARIO
            if (User::exists()) {
                return redirect()->route('install.erase');

             }else{// SI EXISTE LA TABLA, PERO SIN USUARIOS NOS LLEVA A INTRODUCIR EL PRIMER USUARIO

                return view('install/formUserInstall');
             }
        }catch(\Exception $e){
            //SI NO EXISTE LA TABLA user TAMBIÉN REIDIRIGE AL FORMULARIO
           return view('install/formInstall');
        }
    }


    public function createFile(Request $r){

        $host = $r->host;
        $appUrl = $r->appUrl;
        $dbConnection = $r->dbConnection;
        $dbPort = $r->dbPort;
        $namedb = $r->namedb;
        $userdb = $r->userdb;
        $passdb =$r->passdb;

        $env = ".env";

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

        //MIX_PUSHER_APP_KEY= '${PUSHER_APP_KEY}' \n
        //MIX_PUSHER_APP_CLUSTER='${PUSHER_APP_CLUSTER}' \n


        if($archivo = fopen($env,"w")){
            fwrite($archivo, $texto);
        }else {
            //mostrar mensaje para que se haga a mano.
        }

        fclose($archivo);

        $old = public_path('.env');

        $new = "/.env";

        rename(".env", "../.env");

        //Artisan::call('key:generate');

        return redirect()->route('install.migration');
    }

    public function migration(){

        Artisan::call('migrate');

        return redirect()->route('install.createUser');
    }
    public function createUser(){

        return view('install/formUserInstall');
    }

    public function storeUser(Request $r){

        $user = new User();

            $r->validate([
                'password'=>'confirmed',
            ]);

        $user->name = $r->name;
        $user->email = $r->email;
        $user->password = Hash::make($r->password);
        $user->level = '1';

        $user->save();

        return redirect()->route('install.erase');
        //return redirect()->route('user.index');
    }
    public function erase(){
        // BORRAR LAS VISTAS
        $vistas = "../resources/views/install";
        foreach(glob($vistas . "/*") as $file){
            unlink($file);
          }
          rmdir($vistas);

        // MODIFICAR web.php
        //metemos en un array las líneas que queremos reemplazar
        $textoquesebusca = array("Route::get('install', 'InstallController@index')->name('install.index');",
        "Route::get('install/migration', 'InstallController@migration')->name('install.migration');",
        "Route::post('install/storeUser', 'InstallController@storeUser')->name('install.storeUser');",
        "Route::post('install/createFile', 'InstallController@createFile')->name('install.createFile');",
        "Route::get('install/createUser', 'InstallController@createUser')->name('install.createUser');",
        "Route::get('install/erase', 'InstallController@erase')->name('install.erase');");
        // guardamos en $web la ruta hacia el archivo web.php
        $web = '../routes/web.php';
        // la variable $data se llena con el contenido del archivo web.php
        $data = file_get_contents($web);
        // en $datosnuevos hacemos el cambio, se reemplazan las líneas de $textoquesebusca por espacios en blanco
        $datosnuevos = str_replace($textoquesebusca, '', $data);
        // el archivo web.php se modifica con el nuevo contenido, con este método no es necesario abrir y cerrar archivo.
        file_put_contents($web, $datosnuevos);
        //FIN DE MODIFICAR web.php

        // BORRAR CONTROLADOR
        $controlador = '../app/Http/Controllers/InstallController.php';
        unlink($controlador);

        return redirect()->route('user.index');
    }


}

