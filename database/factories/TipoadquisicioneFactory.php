<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tipoadquisicione;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
$factory->define(Tipoadquisicione::class, function (Faker $faker) {
    $dettipoadquisicion = $this->faker->unique()->word(20);
        return [
            'dettipoadquisicion'=> $dettipoadquisicion,
            'slug'=> Str::slug($dettipoadquisicion)
    ];
});
