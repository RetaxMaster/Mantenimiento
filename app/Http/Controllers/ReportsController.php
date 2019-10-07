<?php

namespace App\Http\Controllers;

use App\Master;
use App\Sucursales;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class ReportsController extends Controller {
    
    public function generatePDFMasterReport() {
        $report = request("articulo-maestro-name");
        $view = $report == 0 ? "reports/masterReport" : "reports/masterUniqueReport";

        $master = $report == 0 ? Master::get() : Master::find($report);
        $info = [];

        if ($report != 0) {
            $sucursales = Sucursales::get();
            //Recopilo los datos que voy a insertar
            foreach ($sucursales as $sucursal) {
                $columns = [];
                
                //Traigo los artículos de esta sucursal y de este artículo maestro (Solo puede haber uno por sucursal)
                $articulos = $sucursal->articulos->where("master_id", "=", $master->id)->first();
                $costo = 0;
                $mantenimientos_hechos = 0;
                $mantenimientos_vencidos = 0;
                $individual = 0;
    
                if ($articulos != null) {
    
                    //Obtenemos la cantidad de artículos a los que se les dará mantenimiento
                    $cantidad_articulos_a_mantener = $articulos->cantidad;
                    $individual = $articulos->costo;
    
                    //Veríficamos si ya se le dió mantenimiento
    
                    if ($articulos->mantenimiento_hecho == 1) {
                        $mantenimientos_hechos = $cantidad_articulos_a_mantener;
                        $mantenimientos_vencidos = 0;
                        $costo += ($articulos->costo * $articulos->cantidad);
                    }
                    else if ($articulos->mantenimiento_hecho == 2) {
                        $mantenimientos_hechos = 0;
                        $mantenimientos_vencidos = $cantidad_articulos_a_mantener;
                    }
                }
    
                $columns["name"] = $sucursal->name;
                $columns["cantidad"] = $sucursal->articulos->where("master_id", "=", $master->id)->sum("cantidad");
                $columns["mantenimientos_hechos"] = $mantenimientos_hechos;
                $columns["costos_individual"] = $individual;
                $columns["costos"] = $costo;
                $columns["mantenimientos_vencidos"] = $mantenimientos_vencidos;
    
                array_push($info, $columns);
            }
        }

        $variables = compact("master", "info");
        $pdf = PDF::loadView($view, $variables);
        return $pdf->stream();
    }

}
