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
        $backPath = storage_path('celiamaps.sql');

        $env = ".env";

        $texto =
        "   APP_NAME=CeliaMaps
        APP_ENV=local
        APP_KEY= base64:PS7qybVslICRb5b0KcM2Voeq4ywtHb8JjKQQxcLWup8=
        APP_DEBUG=true
        APP_URL=" . $appUrl . "

        LOG_CHANNEL=stack

        DB_CONNECTION=" . $dbConnection . "
        DB_HOST=" . $host . "
        DB_PORT=" . $dbPort . "
        DB_DATABASE=" . $namedb . "
        DB_USERNAME=" . $userdb . "
        DB_PASSWORD=" . $passdb . "

        MYSQLDUMP_PATH=D:/laragon/bin/mysql/mysql-5.7.24-winx64/bin/mysqldump.exe
        MYSQL_PATH=D:/laragon/bin/mysql/mysql-5.7.24-winx64/bin/mysql.exe
        BACKUP_PATH=" . $backPath ."

        BROADCAST_DRIVER=log
        CACHE_DRIVER=file
        QUEUE_CONNECTION=sync
        SESSION_DRIVER=file
        SESSION_LIFETIME=120

        REDIS_HOST=127.0.0.1
        REDIS_PASSWORD=null
        REDIS_PORT=6379

        MAIL_DRIVER=smtp
        MAIL_HOST=smtp.mailtrap.io
        MAIL_PORT=2525
        MAIL_USERNAME=null
        MAIL_PASSWORD=null
        MAIL_ENCRYPTION=null

        AWS_ACCESS_KEY_ID=
        AWS_SECRET_ACCESS_KEY=
        AWS_DEFAULT_REGION=us-east-1
        AWS_BUCKET=

        PUSHER_APP_ID=
        PUSHER_APP_KEY=
        PUSHER_APP_SECRET=
        PUSHER_APP_CLUSTER=mt1

        MIX_PUSHER_APP_KEY=
        MIX_PUSHER_APP_CLUSTER=
        ";

        if($archivo = fopen($env,"w")){
            fwrite($archivo, $texto);
        }else {
            //mostrar mensaje para que se haga a mano.
        }

        fclose($archivo);

        $old = public_path('.env');

        $new = "/.env";

        rename(".env", "../.env");

        Artisan::call('key:generate');

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
    }
    public function erase(){
        // BORRAR LAS VISTAS
        $vistas = "../resources/views/install";
        // Va borrando los archivos que hay dentro de la carpeta vistas, uno por uno
        // y al final borra la carpeta, ya vacia.
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

