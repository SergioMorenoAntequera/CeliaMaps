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
Route::get('map/up/{id}', 'MapController@moveUp')->name('map.up');
Route::get('map/down/{id}', 'MapController@moveDown')->name('map.down');
// USER /////////////////////////////////////////////////////////////////////////////////////
Route::resource('user', 'UserController');
// STREETS /////////////////////////////////////////////////////////////////////////////////////
Route::resource('street', 'StreetController');
// POINTS /////////////////////////////////////////////////////////////////////////////////////
Route::resource('point', 'PointController');
// HOTSPOT /////////////////////////////////////////////////////////////////////////////////////
Route::resource('hotspot', 'HotspotController');
// AUTH SE MODIFICA LA RUTA PARA ELIMINAR LA OPCIÓN DE REGISTRO //////////////////////////////////
//Auth::routes();
Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
