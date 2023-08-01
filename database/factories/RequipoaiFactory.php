<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Requipoai;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
$factory->define(Requipoai::class, function (Faker $faker) {
    $detpoai = $this->faker->unique()->word(20);
    return [
     'detpoai'=> $detpoai,
     'slug'=> Str::slug($detpoai)
        
    ];
});
