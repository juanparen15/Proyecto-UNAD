<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Producto;
use App\Clase;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
$factory->define(Producto::class, function (Faker $faker) {
    $detproducto = $this->faker->unique()->word(20);
    return [
      'detproducto'=> $detproducto,
        'slug'=> Str::slug($detproducto),
        'clase_id'=> Clase::all()->random()->id        
    ];
});
