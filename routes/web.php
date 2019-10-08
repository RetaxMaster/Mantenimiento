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

Route::get('/', "WebController@loadHome")->name("home");

Route::get('/sucursales', "WebController@loadSucursales")->name("sucursales");

Route::get('/articulos/maestro', "WebController@loadMaster")->name("master");

Route::get('/articulos', "WebController@loadArticulos")->name("articulos");

Route::get('/reportes', "WebController@loadReportes")->name("reportes");

Route::get('/graficos', "WebController@loadGraficos")->name("graficos");

Route::get('/test', "WebController@test")->name("test");

// Llamadas Ajax

Route::post('/getChartData', "ReportsController@getChartData")->name("getChartData");

// -> Llamadas Ajax

// Reportes

Route::post('/generatePDFMasterReport', "ReportsController@generatePDFMasterReport")->name("generatePDFMasterReport");

Route::post('/generatePDFSucursalReport', "ReportsController@generatePDFSucursalReport")->name("generatePDFSucursalReport");

Route::post('/generatePDFHistorialReport', "ReportsController@generatePDFHistorialReport")->name("generatePDFHistorialReport");

// -> Reportes

Auth::routes([
    "register" => false
]);