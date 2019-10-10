<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMantenimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("usuario_id")->unsigned(); // <- Foreign
            $table->bigInteger("articulo_id")->unsigned(); // <- Foreign

            $table->foreign("usuario_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("articulo_id")->references("id")->on("articulos")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mantenimientos');
    }
}
