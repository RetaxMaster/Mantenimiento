<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Sucursales;
use Faker\Generator as Faker;

$factory->define(Sucursales::class, function (Faker $faker) {
    return [
        "name" => $faker->word, 
        "sector_id" => rand(1, 4)
    ];
});
