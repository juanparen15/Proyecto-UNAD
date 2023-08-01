<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tipozona;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
$factory->define(Tipozona::class, function (Faker $faker) {
    $tipozona = $this->faker->unique()->word(20);
        return [
            'tipozona'=> $tipozona,
            'slug'=> Str::slug($tipozona)
    ];
});
