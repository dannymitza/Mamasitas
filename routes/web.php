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
/*
Route::get('/', function () {
    echo "Hey, hey hey";
});
Route::get('parts/', 'Parts@index');
*/
Route::domain('api.localhost')->group(function () {
    Route::get('/', function () {
       echo "API Subdomain";
    });

  Route::get('parts/get/all', 'Parts@index');
  Route::get('part/get/{sap}', 'Parts@get');
  Route::get('part/get/{sap}/sap', 'Parts@getSAP');
  Route::get('part/get/{sap}/boxQty', 'Parts@getBoxQty');
  Route::get('part/get/{sap}/palletQty', 'Parts@getPalletQty');
  Route::get('part/get/{sap}/backupQty', 'Parts@getBackupQty');
  Route::get('part/get/{sap}/SLoc', 'Parts@getProductStorageLoc');
  Route::get('part/get/{sap}/plant', 'Parts@getProductPlant');
  Route::get('part/get/{sap}/costCenter', 'Parts@getCostCenter');
  Route::get('part/get/{sap}/matInfo', 'Parts@getMatInfo');
  Route::get('part/get/{sap}/MFBF', 'Parts@getMFBFInfo');

  Route::get('part/set/{sap}/quantity/{quantity}', 'Parts@setMatQuantity');
});
Route::domain('helpdesk.localhost')->group(function () {
    Route::get('/', function () {
       echo "HelpDesk Subdomain";
    });
});
Route::domain('localhost')->group(function () {
    Route::get('/', function () {
       echo "Main Domain";
    });
});