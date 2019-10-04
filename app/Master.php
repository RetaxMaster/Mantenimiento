<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Master extends Model {

    protected $fillable = ["name"];

    // Relaciones
    
    public function articulos() {
        return $this->hasMany(Articulos::class, 'master_id');
    }
    
    // -> Relaciones

}