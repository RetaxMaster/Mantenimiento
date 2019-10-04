<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursales extends Model {
    
    protected $fillable = ["name", "sector_id"];

    // Relaciones
    
    public function sector() {
        return $this->belongsTo(Sectores::class, 'sector_id');
    }

    public function articulos() {
        return $this->hasMany(Articulos::class, 'sucursal_id');
    }
    
    // -> Relaciones
    
}
