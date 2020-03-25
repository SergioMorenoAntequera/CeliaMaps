<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Image;
use App\Hotspot;
use DB;



class BackupController extends Controller
{


    //////////////////////// SOLO LOS USUARIOS LOGUEADOS PUEDEN UTILIZAR CREATE Y RESTORE /////////////////////////////
    public function __construct(){

        $this->middleware("auth")->only("index", "create","restore");
    }

  //////////////////////////// VISTA DONDE SE UBICAN LOS CONTROLES DEL BACKUP, POR AHORA //////////
   public function index(){

       return view('backup.index');
   }
   ///////////////////////////////// CREAR COPIA DE SEGURIDAD ///////////////////////////////////
    public function create(){

        $dbhost = env('DB_HOST');
        $dbname = env('DB_DATABASE');
        $dbuser = env('DB_USERNAME');
        $dbpass = env('DB_PASSWORD');
        $mysqldump = env('MYSQLDUMP_PATH');
        $backup = env('BACKUP_PATH');

        $command = "$mysqldump > mysqldump -h $dbhost -u $dbuser $dbname > $backup";

        system($command);

    }

    //////////////////////////////// RESTAURAR COPIA DE SEGURIDAD /////////////////////////////
    public function restore(){

        $dbhost = env('DB_HOST');
        $dbname = env('DB_DATABASE');
        $dbuser = env('DB_USERNAME');
        $dbpass = env('DB_PASSWORD');
        $mysqlrestore = env('MYSQL_PATH');
        $backup = env('BACKUP_PATH');

        $command = "$mysqlrestore > mysql -h $dbhost -u $dbuser $dbname < $backup";

        system($command);

        //return redirect(route('backup.index'));
    }

    public function copymage(){
        $file = public_path('img\hotspot\alcazaba-almeria-img-01.jpg');
        //dd($file);
        $destino = public_path('storage\alcazaba-almeria-img-01.jpg');
        //dd($destino);
        Storage::copy($file, $destino);
    }


}

