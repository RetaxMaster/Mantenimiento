<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulos extends Model {

    protected $fillable = ["master_id", "sucursal_id", "picture", "manual", "costo", "fecha_mantenimiento"];

    // Relaciones
    
    public function sucursal() {
        return $this->belongsTo(Sucursales::class, 'sucursal_id');
    }

    public function master() {
        return $this->belongsTo(Master::class, 'master_id');
    }

    public function mantenimientos() {
        return $this->hasMany(Mantenimientos::class, 'articulo_id');
    }
    
    // -> Relaciones
    
}
