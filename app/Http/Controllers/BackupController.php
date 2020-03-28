<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Image;
use App\Hotspot;
use DB;
use Exception;
use ZipArchive;

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

        // PARA CREAR EL BACKUP DE LA BASE DE DATOS

        $dbhost = env('DB_HOST');
        $dbname = env('DB_DATABASE');
        $dbuser = env('DB_USERNAME');
        $dbpass = env('DB_PASSWORD');
        $mysqldump = env('MYSQLDUMP_PATH');
        $backup = env('BACKUP_PATH');

        $command = "$mysqldump > mysqldump -h $dbhost -u $dbuser $dbname > $backup";

        system($command);

        // AHORA LA COPIA DE LA CARPETA DE LAS IMÁGENES.

        try{
            //CREAR ARCHIVO ZIP ////////////////////////////////////
            $zip_file = "copiaImagenes.zip";

            //SE INSTANCIA LA CLASE ZipArchive, DE PHP PARA CREAR ARCHIVOS ZIP
            $zip = new ZipArchive();

            // ABRIMOS EL ARCHIVO $zip  Y CON ZipArchive::CREATE, SE CREA EL ARCHIVO SI NO EXISTE
            $open = $zip->open($zip_file, ZipArchive::CREATE);

            // ENTONCES, SI EXISTE Y ESTÁ ABIERTO....
            if($open === TRUE){

                // AÑADIMOS LA RUTA DE LAS IMÁGENES /////////////
                $path = public_path('img');

                // AHORA, RECORRE LA CARPETA DE ORIGEN ($path), Y SI HAY SUBDIRECTORIOS, TAMBIÉN LOS COPIA
                $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));

                // EN UN BUCLE, SI ENCUENTRA UN SUBDIRECTORIO, GUARDA EN $filePath SU RUTA Y
                // EN $relativePath GUARDA DENTRO DE LA CARPETA PRINCIPAL ('hotspotsCopy/'),
                // EL SUBDIRECTORIO, AÑADIENDOSE TODO, AL FINAL AL ARCHIVO ZIP.
                foreach($files as $name=>$file){
                    if(!$file->isDir()){
                        $filePath = $file->getRealPath();

                        $relativePath = 'img/'.substr($filePath, strlen($path) + 1);

                        $zip->addFile($filePath, $relativePath);
                    }
                }
                // AL ACABAR, SE CIERRA EL ARCHIVO ZIP
                $zip->close();
                //return redirect(route('backup.index'));
            }else{
                echo 'fallando';
            }

        }catch(Exception $e){

        }
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

        try{

            $zip = new ZipArchive;
            //$open = $zip->open($zip_file, ZipArchive::CREATE);

            if ($zip->open('copiaImagenes.zip') === TRUE) {
                $path = public_path('/');
                $zip->extractTo($path);
                $zip->close();
                //return redirect(route('backup.index'));
            } else {
                echo 'failed';
            }

            }catch(Exception $e){

            }

        //return redirect(route('backup.index'));
    }
    public function restoreDir(){
          try{

        $zip = new ZipArchive;
        //$open = $zip->open($zip_file, ZipArchive::CREATE);

        if ($zip->open('copiaImagenes.zip') === TRUE) {
            $path = public_path('/');
            $zip->extractTo($path);
            $zip->close();
            echo 'ok';
        } else {
            echo 'failed';
        }

        }catch(Exception $e){

        }


    }
}

