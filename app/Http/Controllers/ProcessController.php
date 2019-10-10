<?php

namespace App\Http\Controllers;

use App\Sectores;
use App\Sucursales;
use Illuminate\Http\Request;

class ProcessController extends Controller {
    
    //Agrega un sector
    public function addSector() {
        $sectorName = request("sectorName");
        $sector = Sectores::create([
            "name" => $sectorName
        ]);

        return json_encode([
            "sector" => $sector
        ]);
    }

    //Agrega una sucursal
    public function addSucursal() {
        $sucursalName = request("sucursalName");
        $sectorId = request("sectorId");

        $sucursal = Sucursales::create([
            "name" => $sucursalName,
            "sector_id" => $sectorId
        ]);

        return json_encode([
            "sucursal" => $sucursal
        ]);
    }

    //Elimina una sucursal
    public function deleteSucursal() {
        $id = request("id");
        Sucursales::destroy($id);
        return json_encode([
            "status" => "true"
        ]);
    }

    //Elimina una sucursal
    public function deleteSector() {
        $id = request("id");
        Sectores::destroy($id);
        return json_encode([
            "status" => "true"
        ]);
    }

}
