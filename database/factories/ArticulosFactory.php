<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Articulos;
use Faker\Generator as Faker;

$factory->define(Articulos::class, function (Faker $faker) {
    return [
        "master_id" => rand(1, 10), 
        "sucursal_id" => rand(1, 10), 
        "picture" => "logo.png", 
        "manual" => null, 
        "costo" => rand(50, 500), 
        "cantidad" => rand(5, 50), 
        "fecha_mantenimiento" => $faker->date("Y-m-d", "2022-08-15")
    ];
});
