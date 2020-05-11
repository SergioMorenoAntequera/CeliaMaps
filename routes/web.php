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
// USER /////////////////////////////////////////////////////////////////////////////////////
Route::resource('user', 'UserController');
Route::delete('user/deleteAjax/{id}', 'UserController@deleteAjax')->name('user.deleteAjax');
// STREETS /////////////////////////////////////////////////////////////////////////////////////
Route::get('street/admin', 'StreetController@admin')->name('street.admin');
Route::get('street/storeAjax', 'StreetController@storeAjax')->name('street.storeAjax');
Route::get('street/updateAjax', 'StreetController@updateAjax')->name('street.updateAjax');
Route::get('street/updatePositionAjax', 'StreetController@updatePositionAjax')->name('street.updatePositionAjax');
Route::get('street/destroyAjax', 'StreetController@destroyAjax')->name('street.destroyAjax');
Route::resource('street', 'StreetController');
// POINTS /////////////////////////////////////////////////////////////////////////////////////
Route::resource('point', 'PointController');
// IMAGES /////////////////////////////////////////////////////////////////////////////////////
Route::resource('image', 'ImageController');
// HOTSPOT /////////////////////////////////////////////////////////////////////////////////////
Route::get('hotspot/admin', 'HotspotController@admin')->name('hotspot.admin');
Route::get('hotspot/storeAjax', 'HotspotController@storeAjax')->name('hotspot.storeAjax');
Route::get('hotspot/updateAjax', 'HotspotController@updateAjax')->name('hotspot.updateAjax');
Route::get('hotspot/updatePositionAjax', 'HotspotController@updatePositionAjax')->name('hotspot.updatePositionAjax');
Route::get('hotspot/gallery', 'HotspotController@gallery')->name('hotspot.gallery');
Route::delete('hotspot/deleteAjax/{id}', 'HotspotController@deleteAjax')->name('hotspot.deleteAjax');
Route::get('hotspot/getAllAjax', 'HotspotController@getAllAjax')->name('hotspot.getAjax');
Route::get('hotspot/searchAjax', 'HotspotController@searchAjax')->name('hotspot.search');
Route::get('hotspot/destroyAjax', 'HotspotController@destroyAjax')->name('hotspot.destroyAjax');
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
// MARKERS /////////////////////////////////////////////////////////////////////////////////////
Route::get('marker', 'MarkerController@admin')->name('marker.admin');
Route::get('marker/store', 'MarkerController@store')->name('marker.store');
Route::get('marker/destroy', 'MarkerController@destroy')->name('marker.destroy');
Route::get('marker/update', 'MarkerController@update')->name('marker.update');
// Route::resource('marker', 'MarkerController');
// SETTINGS ////////////////////////////////////////////////////////////////////////////////////////
Route::get('setting/mainView', 'SettingsController@mainView')->name('setting.mainView');
Route::get('setting/saveMainView', 'SettingsController@saveMainView')->name('setting.saveMainView');
Route::get('setting/homeInfo', 'SettingsController@homeInfo')->name('setting.home');
Route::get('setting', 'SettingsController@index')->name('setting.index');
// INSTALL /////////////////////////////////////////////////////////////////////////////////////////
Route::get('install', 'InstallController@index')->name('install.index');
Route::get('install/migration', 'InstallController@migration')->name('install.migration');
Route::post('install/storeUser', 'InstallController@storeUser')->name('install.storeUser');
Route::post('install/createFile', 'InstallController@createFile')->name('install.createFile');
Route::get('install/createUser', 'InstallController@createUser')->name('install.createUser');
Route::get('install/erase', 'InstallController@erase')->name('install.erase');
