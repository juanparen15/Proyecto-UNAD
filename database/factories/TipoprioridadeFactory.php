<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tipoprioridade;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
$factory->define(Tipoprioridade::class, function (Faker $faker) {
    $detprioridad = $this->faker->unique()->word(20);
    return [
        'detprioridad'=> $detprioridad,
        'slug'=> Str::slug($detprioridad)
    ];
});
