<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// MAPS /////////////////////////////////////////////////////////////////////////////////////
Route::resource('map', 'MapController');
// USER /////////////////////////////////////////////////////////////////////////////////////
Route::resource('user', 'UserController');
// STREETS /////////////////////////////////////////////////////////////////////////////////////
Route::resource('street', 'StreetController');
// POINTS /////////////////////////////////////////////////////////////////////////////////////
Route::resource('point', 'PointController');
// HOTSPOT /////////////////////////////////////////////////////////////////////////////////////
Route::resource('hotspot', 'HotspotController');