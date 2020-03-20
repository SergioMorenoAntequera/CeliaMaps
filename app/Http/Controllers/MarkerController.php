<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarkerController extends Controller
{
    public function admin(){
        return view("marker.admin");
    }
}
