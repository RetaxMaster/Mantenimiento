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
        $sucursal = 1;
        $articulos = ($sucursal == 0) ? Articulos::get() : Articulos::where("sucursal_id", "=", $sucursal)->get();

        $start_date = date("Y-m-d");
        $end_date = add_time($start_date, env("DEATH_DAYS") . " días");

        $data["total"] = $articulos->count();
        $data["realizados"] = $articulos->where("mantenimiento_hecho", "=", 1)->count();
        $data["vencidos"] = $articulos->where("mantenimiento_hecho", "=", 2)->count();
        $data["porVencer"] = $articulos->where("mantenimiento_hecho", "=", 0)->whereBetween("fecha_mantenimiento", [$start_date, $end_date])->count();
        $data["pendientes"] = $articulos->where("mantenimiento_hecho", "=", 0)->count();
        return json_encode($data);
    }

}
