<?php

namespace App\Http\Controllers;

use App\Articulos;
use App\Master;
use App\Sectores;
use App\Sucursales;
use App\User;
use Illuminate\Http\Request;

class WebController extends Controller {
    
    //Carga la página principal
    public function loadHome() {
        return view("home");
    }

    //Carga la página de sucursales
    public function loadSucursales() {
        $sucursales = Sucursales::get();
        $sectores = Sectores::get();
        $variables = compact("sucursales", "sectores");
        return view("sucursales", $variables);
    }

    //Carga la página de artículos maestros
    public function loadMaster() {
        $masters = Master::get();
        $variables = compact("masters");
        return view("master", $variables);
    }

    //Carga la página de articulos individuales
    public function loadArticulos() {
        $articulos = Articulos::get();
        $sucursales = Sucursales::get();
        $masters = Master::get();
        $users = User::where("rol", "=", "1")->get();
        $variables = compact("articulos", "users", "sucursales", "masters");
        return view("articulos", $variables);
    }

    //Carga la página de reportes
    public function loadReportes() {
        $sucursales = Sucursales::get();
        $masters = Master::get();
        $variables = compact("sucursales", "masters");
        return view("reportes", $variables);
    }

    //Carga la página de los gráficos
    public function loadGraficos() {
        $sucursales = Sucursales::get();
        $variables = compact("sucursales");
        return view("graficos", $variables);
    }

    //Tests de la página
    public function test() {
        $pdf = PDF::loadView("reports/report");
        return $pdf->stream();
    }

}
