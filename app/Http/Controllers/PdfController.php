<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PDF;
use App\Street;

class PdfController extends Controller
{
    
    public function ver(){
       
        

        return view('search.probandopdf');
    }
    
    public function download()
{

    $data = ['title' => 'CeliaMaps'];

    $pdf = PDF::loadView('search.probandopdf', $data);
 
    return $pdf->download('probandopdf.pdf');

    //return PDF::loadView('search.probandopdf', $data)
    //->stream('probandopdf.pdf');

/*
   $data = ['title' => 'CeliaMaps'];
   //$streetList = Street::all();
   
    $pdf = PDF::loadView('search.probandopdf', $data);
 
    return $pdf->download('probandopdf.pdf');

    //$pdf = \PDF::loadView('search/searchStreet', $data);
 
    //return $pdf->download('archivo.pdf');

   // return PDF::loadView('search/probandopdf', $data)->stream('archivo.pdf');
*/
}}
