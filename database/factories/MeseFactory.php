<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Mese;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
$factory->define(Mese::class, function (Faker $faker) {
    $nommes = $this->faker->unique()->word(20);
            return [
                'nommes'=> $nommes,
                'slug'=> Str::slug($nommes)
    ];
});
