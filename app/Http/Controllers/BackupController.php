<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log as FacadesLog;



class BackupController extends Controller
{

  //////////////////////////// VISTA DONDE SE UBICAN LOS CONTROLES DEL BACKUP, POR AHORA //////////////////////////// 
   public function index(){
       
       return view('backup.index');
   }
   ///////////////////////////////// CREAR COPIA DE SEGURIDAD ////////////////////////////
    public function create(){

        $dbhost = env('DB_HOST','localhost');
        $dbname = env('DB_DATABASE','celiamaps');
        $dbuser = env('DB_USERNAME','root');
        $dbpass = env('DB_PASSWORD','');
        $mysqldump = env('MYSQLDUMP_PATH','D:/laragon/bin/mysql/mysql-5.7.24-winx64/bin/mysqldump.exe');
        $backup = env('BACKUP_PATH','D:/laragon/www/CeliaMaps/storage/celiamapsaversifunciona2.sql');

        //dd($backup);

        //$command = "D:/laragon/bin/mysql/mysql-5.7.24-winx64/bin/mysqldump.exe > mysqldump -h localhost -u root celiamaps > D:/laragon/www/CeliaMaps/storage/celiamapsaversifunciona.sql";
        
        $command = "$mysqldump > mysqldump -h $dbhost -u $dbuser $dbname > $backup"; 
        //dd($command);
        
        system($command);
        //echo($output);
    }
      
    //////////////////////////////// RESTAURAR COPIA DE SEGURIDAD /////////////////////////////
    public function restore(){
                
        $dbhost = env('DB_HOST','localhost');
        $dbname = env('DB_DATABASE','celiamaps');
        $dbuser = env('DB_USERNAME','root');
        $dbpass = env('DB_PASSWORD','');
        $mysqlrestore = env('MYSQL_PATH','D:/laragon/bin/mysql/mysql-5.7.24-winx64/bin/mysql.exe');
        $backup = env('BACKUP_PATH','D:/laragon/www/CeliaMaps/storage/celiamapsaversifunciona2.sql');
        //dd($backup);

        $command = "$mysqlrestore > mysql -h $dbhost -u $dbuser $dbname < $backup"; 
        
        system($command);
       

    }
}

/*
 $dbhost = env('DB_HOST','localhost');
        $dbname = env('DB_DATABASE','celiamaps');
        $dbuser = env('DB_USERNAME','root');
        $dbpass = env('DB_PASSWORD','');
        $mysqldump = env('MYSQLDUMP_PATH','C:/laragon/bin/mysql/mysql-5.7.24-winx64/bin/mysqldump.exe');
        $backup = env('BACKUP_PATH','C:/laragon/www/CeliaMaps/storage/backup/celiamaps.sql');

        $command = "$mysqldump > mysqldump -h $dbhost -u $dbuser -p$dbpass $dbname > $backup"; 
        */


