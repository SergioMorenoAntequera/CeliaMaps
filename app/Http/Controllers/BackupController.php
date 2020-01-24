<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log as FacadesLog;



class BackupController extends Controller
{
   //////////////////////////// VISTA DONDE SE UBICAN LOS CONTROLES DEL BACKUP //////////////////////////// 
   public function index(){
       return view('backup.index');
   }
   ///////////////////////////////// CREAR COPIA DE SEGURIDAD ////////////////////////////
    public function create(){

        $command = "C:/laragon/bin/mysql/mysql-5.7.24-winx64/bin/mysqldump.exe > mysqldump -h localhost -u root celiamaps > C:/laragon/www/CeliaMaps/storage/backup/celiamaps.sql"; 
       
        system($command);
      
    //////////////////////////////// RESTAURAR COPIA DE SEGURIDAD /////////////////////////////
    public function restore(){
                
        $command = "C:/laragon/bin/mysql/mysql-5.7.24-winx64/bin/mysql.exe > mysqldump -h localhost -u root celiamaps < C:/laragon/www/CeliaMaps/storage/backup/celiamaps.sql";
        
        system($command);
       

    }
}




