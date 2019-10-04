<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Mantenimientos;
use Faker\Generator as Faker;

$factory->define(Mantenimientos::class, function (Faker $faker) {
    return [
        "usuario_id" => rand(1, 5), 
        "articulo_id" => rand(1, 100)
    ];
});
