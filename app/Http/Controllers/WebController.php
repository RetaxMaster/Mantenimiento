<?php

namespace App\Http\Controllers;

use App\Articulos;
use App\Mantenimientos;
use App\Master;
use App\Sectores;
use App\Sucursales;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebController extends Controller {

    public function __construct() {
        $this->middleware("auth");

        /*
        
        admin: El rol de admin abarca únicamente a usuarios administradores
        planificador: El rol de planificador abarca a usuarios planificadores como administradores
        usuario: El rol de usuario abarca únicamente a usuarios normales
        
        */

        //Solo lso administradores puedenc rear usuarios
        $this->middleware("admin", [
            "only" => [
                "loadRegister"
            ]
        ]);
        //Ni planificadores ni administradores pueden acceder a la pantalla de realización de mantenimientos, solo los usuarios que serán los trabajadores que se encanrgarán de decir si ya hicieron el mantenimiento o no
        $this->middleware("planificador", [
            "except" => [
                "loadHome",
                "downloadManual"
            ]
        ]);
        //Limito a que solo los usuarios puedan
        $this->middleware("usuario", [
            "only" => [
                "loadHome"
            ]
        ]);
    }
    
    //Carga la página principal
    public function loadHome() {

        $mantenimientos = Mantenimientos::select(["masters.name", "articulos.fecha_mantenimiento", "articulos.manual", "mantenimientos.articulo_id", "articulos.mantenimiento_hecho"])
        ->join("articulos", "mantenimientos.articulo_id", "articulos.id")
        ->join("masters", "articulos.master_id", "masters.id")
        ->where("usuario_id", "=", auth()->user()->id)
        ->where("mantenimiento_hecho", "=", "0")
        ->orWhere("mantenimiento_hecho", "=", "2")
        ->get();

        $variables = compact("mantenimientos");
        return view("home", $variables);
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

    //Carga la página para registrar un usuario
    public function loadRegister() {
        return view("auth/register");
    }

    //Descarga un manual de mantenimiento
    public function downloadManual($name) {
        return response()->download(storage_path("media/manuales/".$name));
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
