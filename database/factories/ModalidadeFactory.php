<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Modalidade;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
$factory->define(Modalidade::class, function (Faker $faker) {
    $detmodalidad = $this->faker->unique()->word(20);
        return [
            'detmodalidad'=> $detmodalidad,
            'slug'=> Str::slug($detmodalidad)
    ];
});
