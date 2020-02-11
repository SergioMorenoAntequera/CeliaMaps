<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PDF;

class PdfController extends Controller
{

    public function ver(){

        return view('search/probandopdf');
    }
    public function download()
{
   $data = ['titulo' => 'Celia Maps'];
   
    $pdf = \PDF::loadView('search/probandopdf', $data);
 
    return $pdf->download('archivo.pdf');

    //$pdf = \PDF::loadView('search/searchStreet', $data);
 
    //return $pdf->download('archivo.pdf');

   // return PDF::loadView('search/probandopdf', $data)->stream('archivo.pdf');

}}
