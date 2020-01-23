<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log as FacadesLog;


class BackupController extends Controller
{
   public function index(){
       return view('backup.index');
   }
   
    public function create(){

    
        $dbhost = 'localhost';
        $dbname = 'celiamaps';
        $dbuser = 'root';
        $dbpass = '';
        //$backup_file = $dbname. "-" .date("Y-m-d-H-i-s"). ".sql";  
        $backup_file = $dbname.".sql";        
        
        
        // comando a ejecutar
        // $command = "mysqldump --opt -h $dbhost -u $dbuser -p$dbpass $dbname | gzip > $backup_file";
        $command = "mysqldump -h $dbhost -u $dbuser -p $dbpass $dbname > $backup_file";
 
        // ejecución y salida de éxito o errores
        system($command,$output);
        echo $output;

       
   }

   public function restore(){
    exec('mysqldump -h localhost -u root celiamaps < /storage/app/backup.sql');

   }
}

//$backup_file = $dbname . date("Y-m-d-H-i-s") . '.gz';
//$backup_file = "/storage/app/" .$dbname. "-" .date("Y-m-d-H-i-s"). ".sql";
// https://voragine.net/weblogs/como-hacer-copias-de-seguridad-de-bases-de-datos-con-php-y-mysqldump



