<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Familia;
use App\Segmento;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
$factory->define(Familia::class, function (Faker $faker) {
    $detfamilia = $this->faker->unique()->word(20);
    return [
        'detfamilia'=> $detfamilia,
        'slug'=> Str::slug($detfamilia),
        'segmento_id'=> Segmento::all()->random()->id
    ];
});
