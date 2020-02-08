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

/*Route::get('/', function () {
    return view('map');
});*/
Route::get('/test', function () {
    return view('test');
});

// MAPS /////////////////////////////////////////////////////////////////////////////////////
Route::get('/', 'MapController@map')->name('map.map');
Route::get('map/up', 'MapController@moveUp')->name('map.up');
Route::get('map/down', 'MapController@moveDown')->name('map.down');
Route::get('map/search', 'MapController@search')->name('map.search');
Route::get('map/align/{id}', 'MapController@alignMap')->name('map.align');
Route::get('map/saveAlign/{id}', 'MapController@saveAlign')->name('map.saveAlign');
Route::resource('map', 'MapController');
// USER /////////////////////////////////////////////////////////////////////////////////////
Route::resource('user', 'UserController');
// STREETS /////////////////////////////////////////////////////////////////////////////////////
Route::resource('street', 'StreetController');
// POINTS /////////////////////////////////////////////////////////////////////////////////////
Route::resource('point', 'PointController');
// HOTSPOT /////////////////////////////////////////////////////////////////////////////////////
Route::resource('hotspot', 'HotspotController');
// AUTH ///////////////////////////////////////////////////////////////////////////////////////
Auth::routes();
//Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

// BACKUP /////////////////////////////////////////////////////////////////////////////////////////
Route::get('backup/index', 'BackupController@index')->name('backup.index');
Route::get('backup/create', 'BackupController@create')->name('backup.create');
Route::get('backup/restore', 'BackupController@restore')->name('backup.restore');

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/home', 'HomeController@index')->name('home');
