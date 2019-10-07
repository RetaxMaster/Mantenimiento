<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("master_id")->unsigned(); // <- Foreign
            $table->bigInteger("sucursal_id")->unsigned(); // <- Foreign
            $table->string("picture")->default("logo.png");
            $table->string("manual")->nullable()->default(null);
            $table->double("costo");
            $table->integer("cantidad");
            $table->date("fecha_mantenimiento");
            $table->tinyInteger("mantenimiento_hecho")->default(0);

            $table->foreign("master_id")->references("id")->on("masters");
            $table->foreign("sucursal_id")->references("id")->on("sucursales");
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
        Schema::dropIfExists('articulos');
    }
}
