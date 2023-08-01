<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Area;
use App\Dependencia;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Area::class, function (Faker $faker) {
    $nomarea = $this->faker->unique()->word(20);
    return [
        'nomarea'=> $nomarea,
        'slug'=> Str::slug($nomarea),
        'dependencia_id'=> Dependencia::all()->random()->id
    ];
});
