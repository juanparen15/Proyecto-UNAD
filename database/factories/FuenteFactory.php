<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Fuente;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
$factory->define(Fuente::class, function (Faker $faker) {
    $detfuente = $this->faker->unique()->word(20);
    return [
        'detfuente'=> $detfuente,
        'slug'=> Str::slug($detfuente)
    ];
});
