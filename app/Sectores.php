<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sectores extends Model {
    
    protected $fillable = ["name"];

    // Relaciones
    
    public function sucursales() {
        return $this->hasMany(Sucursales::class, 'sector_id');
    }
    
    // -> Relaciones

}
