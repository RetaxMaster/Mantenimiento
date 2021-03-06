<?php

namespace App\Http\Controllers;

use App\Articulos;
use App\Classes\RetaxMaster;
use App\Mantenimientos;
use App\Master;
use App\Sectores;
use App\Sucursales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProcessController extends Controller {

    public function __construct() {
        $this->middleware("auth");        
    }
    
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

    //Agrega un artículo maestro
    public function addMaster() {
        $articuloName = request("articuloName");
        $master = Master::create([
            "name" => $articuloName
        ]);

        return json_encode([
            "master" => $master
        ]);
    }

    //Agrega un artículo maestro
    public function deleteMaster() {
        $id = request("id");
        Master::destroy($id);
        return json_encode([
            "status" => "true"
        ]);
    }

    //Agrega una artículo a una sucursal
    public function addArticulo() {
        $insertArray = [];

        $insertArray["master_id"] = request("articulo-name");
        $insertArray["sucursal_id"] = request("sucursal-name");
        $insertArray["costo"] = request("cost");
        $insertArray["cantidad"] = request("cantidad");
        $mantainmentDate = request("mantainment-date");
        $users = json_decode(request("users"));

        $mantainmentDate = explode("-", $mantainmentDate);
        $mantainmentDate = $mantainmentDate[2] . "-" . $mantainmentDate[1] . "-" . $mantainmentDate[0];

        $insertArray["fecha_mantenimiento"] = $mantainmentDate;

        // Primero subo los archivos
        $response["alert"] = "";
        
        if (request()->hasFile("picture")) {
            $image = RetaxMaster::uploadImage(request()->file("picture"), "uploaded_images");
            if (isset($image["name"])) {
                $insertArray["picture"] = $image["name"];
            }
            else {
                $response["alert"] .= "Surgió un problema subiendo esta imagen: " . $image["message"]."<br>";
            }
        }

        if (request()->hasFile("manual")) {
            $file = RetaxMaster::uploadFile(request()->file("manual"), "manuales");
            if (isset($file["name"])) {
                $insertArray["manual"] = $file["name"];
            }
            else {
                $response["alert"] .= "Surgió un problema subiendo este manual: " . $file["message"]."<br>";
            }
        }
        
        // -> Primero subo los archivos

        $articulosDB = Articulos::create($insertArray);
        $articulos["id"] = $articulosDB->id;
        $articulos["name"] = $articulosDB->master->name;

        foreach ($users as $user) {
            Mantenimientos::create([
                "usuario_id" => $user,
                "articulo_id" => $articulosDB->id
            ]);
        }

        $response["status"] = "true";
        $response["articulos"] = $articulos;

        return json_encode($response);
    }

    //Elimina un artículo de una sucursal
    public function deleteArticulo() {
        $id = request("id");
        $articulo = Articulos::find($id);

        Storage::delete(["uploaded_images/".$articulo->picture, "manuales/".$articulo->manual]);

        $articulo->delete();

        return json_encode([
            "status" => "true"
        ]);
    }
    
    //Obtiene la lista de artículos según los filtros pasados
    public function getArticulos() {
        $query = request("query");
        $sucursal = request("sucursal");

        //Busco las coincidencias en la tabla de artículos maestros, como es posible que traiga más de un artículo
        $articulos = Master::select(["masters.name", "articulos.id"])->join("articulos", "articulos.master_id", "masters.id")->where("name", "LIKE", "%$query%");

        if($sucursal != 0)
            $articulos = $articulos->where("sucursal_id", "=", $sucursal);

        $response["articulos"] = $articulos->orderBy("id", "DESC")->get();
        $response["status"] = "true";
        return json_encode($response);
    }

    //Marca un mantenimiento como hecho
    public function completeMantainment() {
        $id = request("id");
        $articulos = Articulos::find($id);
        if ($articulos != null) {
            $articulos->mantenimiento_hecho = 1;
            $articulos->save();
            $articulos->fresh();
            $response["status"] = "true";
        }
        else {
            $response["status"] = "false";
            $response["responseText"] = "No se encontró el artículo";
        }

        return json_encode($response);

    }

}
