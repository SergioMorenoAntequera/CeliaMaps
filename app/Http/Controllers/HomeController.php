<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function home()
    {
        $data['homeSettings'] = Setting::getHomeOptions();
        return view('home', $data);
    }

    public function login()
    {
        return view('auth.login');
    }
}
