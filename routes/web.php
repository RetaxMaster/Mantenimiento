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

Route::get('/articulos/maestros', "WebController@loadMaster")->name("master");

Route::get('/articulos', "WebController@loadArticulos")->name("articulos");

Route::get('/reportes', "WebController@loadReportes")->name("reportes");

Route::get('/graficos', "WebController@loadGraficos")->name("graficos");



Auth::routes([
    "register" => false
]);