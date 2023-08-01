<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Estadovigencia;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
$factory->define(Estadovigencia::class, function (Faker $faker) {
    $detestadovigencia = $this->faker->unique()->word(20);
    return [
        'detestadovigencia'=> $detestadovigencia,
        'slug'=> Str::slug($detestadovigencia)
    ];
});
