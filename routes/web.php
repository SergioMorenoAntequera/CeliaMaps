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

// HOME /////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/home', 'HomeController@home')->name('home');
// Route::get('/login', 'HomeController@login')->name('home.login');

// MAPS /////////////////////////////////////////////////////////////////////////////////////
Route::get('/', 'MapController@map')->name('map.map');
Route::get('map/up', 'MapController@moveUp')->name('map.up');
Route::get('map/down', 'MapController@moveDown')->name('map.down');
Route::get('map/search', 'MapController@search')->name('map.search');
Route::get('map/streets', 'MapController@getStreets')->name('map.streets');
Route::get('map/align/{id}', 'MapController@alignMap')->name('map.align');
Route::get('map/saveAlign/{id}', 'MapController@saveAlign')->name('map.saveAlign');
Route::resource('map', 'MapController');
// MARKERS /////////////////////////////////////////////////////////////////////////////////////
Route::get('marker', 'MarkerController@admin')->name('marker.admin');
Route::get('marker/store', 'MarkerController@store')->name('marker.store');
Route::get('marker/destroy', 'MarkerController@destroy')->name('marker.destroy');
Route::get('marker/update', 'MarkerController@update')->name('marker.update');
// Route::resource('marker', 'MarkerController');
// USER /////////////////////////////////////////////////////////////////////////////////////
Route::resource('user', 'UserController');
Route::delete('user/deleteAjax/{id}', 'UserController@deleteAjax')->name('user.deleteAjax');
// STREETS /////////////////////////////////////////////////////////////////////////////////////
Route::get('street/admin', 'StreetController@admin')->name('street.admin');
Route::resource('street', 'StreetController');
// POINTS /////////////////////////////////////////////////////////////////////////////////////
Route::resource('point', 'PointController');
// HOTSPOT /////////////////////////////////////////////////////////////////////////////////////
Route::delete('hotspot/deleteAjax/{id}', 'HotspotController@deleteAjax')->name('hotspot.deleteAjax');
Route::get('hotspot/getAllAjax', 'HotspotController@getAllAjax')->name('hotspot.getAjax');
Route::get('hotspot/gallery', 'HotspotController@gallery')->name('hotspot.gallery');
Route::get('hotspot/searchAjax', 'HotspotController@searchAjax')->name('hotspot.search');
Route::resource('hotspot', 'HotspotController');
// AUTH ///////////////////////////////////////////////////////////////////////////////////////
Auth::routes();
Auth::routes(['register' => false]);
// BACKUP /////////////////////////////////////////////////////////////////////////////////////////
Route::get('backup', 'BackupController@index')->name('backup.index');
Route::get('backup/create', 'BackupController@create')->name('backup.create');
Route::get('backup/restore', 'BackupController@restore')->name('backup.restore');
Route::get('backup/restoreDir', 'BackupController@restoreDir')->name('backup.restoreDir');
// SEARCH /////////////////////////////////////////////////////////////////////////////////////
Route::get('search/index', 'SearchController@index')->name('search.index');
Route::post('search', 'SearchController@search')->name('search.search');
Route::get('search/download/{id}', 'SearchController@download')->name('search.download');
Route::get('search/inform/{id}', 'SearchController@inform')->name('search.inform');
Route::get('search/show/{id}', 'SearchController@show')->name('search.show');
// PDF /////////////////////////////////////////////////////////////////////////////////////////////
//Route::get('pdf/ver', 'PdfController@ver')->name('pdf.ver');
//Route::get('pdf/download', 'PdfController@download')->name('pdf.download');



