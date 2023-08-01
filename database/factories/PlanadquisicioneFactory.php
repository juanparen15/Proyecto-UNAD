<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Planadquisicione;
use App\Vigenfutura;
use App\Area;
use App\Tipozona;
use App\Estadovigencia;
use App\Familia;
use App\Modalidade;
use App\Tipoproceso;
use App\Tipoadquisicione;
use App\Fuente;
use App\Tipoprioridade;
use App\Mese;
use App\Requipoai;
use App\Requiproyecto;
use App\Segmento;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
$factory->define(Planadquisicione::class, function (Faker $faker) {
    $nota = $this->faker->unique()->word(20);
    return [
        'nota'=> $nota,
        'fechaInicial'=>$this->faker->text(40),
        'fechaFinal'=>$this->faker->text(40),
        'caja'=>$this->faker->text(40),
        'carpeta'=>$this->faker->text(40),
        'tomo'=>$this->faker->text(40),
        'otro'=>$this->faker->text(40),
        'folio'=>$this->faker->text(40),
        'area_id'=> Area::all()->random()->id,
        'modalidade_id'=> Modalidade::all()->random()->id,
        'requiproyecto_id'=> Requiproyecto::all()->random()->id,
        'fuente_id'=> Fuente::all()->random()->id,
        'tipoprioridade_id'=> Tipoprioridade::all()->random()->id,
        'user_id'=> User::all()->random()->id,            
        'familias_id'=> Familia::all()->random()->id,            
        'segmento_id'=> Segmento::all()->random()->id,            
        'slug'=> Str::slug($nota) 
    ];
});
