<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Vigenfutura;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
$factory->define(Vigenfutura::class, function (Faker $faker) {
    $detvigencia = $this->faker->unique()->word(20);
        return [
            'detvigencia'=> $detvigencia,
            'slug'=> Str::slug($detvigencia)
    ];
});
