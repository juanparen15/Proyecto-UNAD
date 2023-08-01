<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Segmento;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
$factory->define(Segmento::class, function (Faker $faker) {
    $detsegmento = $this->faker->unique()->word(20);
        return [
            'detsegmento'=> $detsegmento,
            'slug'=> Str::slug($detsegmento)
    ];
});
