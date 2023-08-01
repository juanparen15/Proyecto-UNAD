<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Dependencia;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
$factory->define(Dependencia::class, function (Faker $faker) {
    $nomdependencia = $this->faker->unique()->word(20);
    return [
        'nomdependencia'=> $nomdependencia,
        'slug'=> Str::slug($nomdependencia)
    ];
});
