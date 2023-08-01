<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tipoproceso;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
$factory->define(Tipoproceso::class, function (Faker $faker) {
    $dettipoproceso = $this->faker->unique()->word(20);
        return [
            'dettipoproceso'=> $dettipoproceso,
            'slug'=> Str::slug($dettipoproceso)
    ];
});
