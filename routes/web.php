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
Route::get('backup', 'BackupController@index')->name('backup.index');
Route::get('backup/create', 'BackupController@create')->name('backup.create');
Route::get('backup/restore', 'BackupController@restore')->name('backup.restore');
// SEARCH /////////////////////////////////////////////////////////////////////////////////////
Route::get('search/index', 'SearchController@index')->name('search.index');
Route::get('search', 'SearchController@search')->name('search.search');
Route::get('search/download', 'SearchController@download')->name('search.download');
Route::get('search/inform', 'SearchController@inform')->name('search.inform');
// PDF /////////////////////////////////////////////////////////////////////////////////////////////
Route::get('pdf/ver', 'PdfController@ver')->name('pdf.ver');
Route::get('pdf/download', 'PdfController@download')->name('pdf.download');

Route::get('/home', 'HomeController@index')->name('home');


