<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Clase;
use App\Familia;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
$factory->define(Clase::class, function (Faker $faker) {
    $detclase = $this->faker->unique()->word(20);
    return [
        'detclase'=> $detclase,
        'slug'=> Str::slug($detclase),
        'familia_id'=> Familia::all()->random()->id
    ];
});
