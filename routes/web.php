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

	Route::get('parts/', 'Parts@index');
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