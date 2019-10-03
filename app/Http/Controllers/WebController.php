<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller {
    
    //Carga la página principal
    public function loadHome() {
        return view("home");
    }

    //Carga la página de sucursales
    public function loadSucursales() {
        return view("sucursales");
    }

    //Carga la página de artículos maestros
    public function loadMaster() {
        return view("master");
    }

    //Carga la página de articulos individuales
    public function loadArticulos() {
        return view("articulos");
    }

    //Carga la página de reportes
    public function loadReportes() {
        return view("reportes");
    }

    //Carga la página de los gráficos
    public function loadGraficos() {
        return view("graficos");
    }

}
