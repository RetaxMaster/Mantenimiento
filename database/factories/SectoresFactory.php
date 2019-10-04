<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Sectores;
use Faker\Generator as Faker;

$factory->define(Sectores::class, function (Faker $faker) {
    return [
        "name" => $faker->word        
    ];
});
