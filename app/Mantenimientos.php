<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mantenimientos extends Model {

    protected $fillable = ["usuario_id", "articulo_id"];

    // Relaciones
    
    public function user() {
        return $this->belongsTo(User::class, "usuario_id");
    }

    public function articulo() {
        return $this->belongsTo(Articulos::class, "articulo_id");
    }
    
    // -> Relaciones

}
