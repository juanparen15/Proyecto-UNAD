<?php

use App\Dependencia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class DependenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Dependencia::create([
          'nomdependencia'=>'CONTROL INTERNO',
          'slug'=> Str::slug('CONTROL INTERNO', '-'),
         ]);

         Dependencia::create([
          'nomdependencia'=>'DESPACHO ALCALDE',
          'slug'=> Str::slug('DESPACHO ALCALDE', '-'),
         ]);
         Dependencia::create([
          'nomdependencia'=>'SECRETARIA DE GOBIERNO',
          'slug'=> Str::slug('SECRETARIA DE GOBIERNO', '-'),
         ]);
         Dependencia::create([
          'nomdependencia'=>'SECRETARIA DE DESARROLLO',
          'slug'=> Str::slug('SECRETARIA DE DESARROLLO', '-'),
         ]);
         Dependencia::create([
          'nomdependencia'=>'SECRETARIA GENERAL',
          'slug'=> Str::slug('SECRETARIA GENERAL', '-'),
         ]);
         Dependencia::create([
          'nomdependencia'=>'SECRETARIA DE HACIENDA',
          'slug'=> Str::slug('SECRETARIA DE HACIENDA', '-'),
         ]);
         Dependencia::create([
          'nomdependencia'=>'SECRETARIA DE OBRAS PUBLICAS',
          'slug'=> Str::slug('SECRETARIA DE OBRAS PUBLICAS', '-'),
         ]);
         Dependencia::create([
          'nomdependencia'=>'SECRETARIA DE PLANEACION',
          'slug'=> Str::slug('SECRETARIA DE PLANEACION', '-'),
         ]);
         Dependencia::create([
          'nomdependencia'=>'INSPECCION TRANSITO Y TRANSPORTE',
          'slug'=> Str::slug('INSPECCION TRANSITO Y TRANSPORTE', '-'),
         ]);
         Dependencia::create([
          'nomdependencia'=>'UMATA',
          'slug'=> Str::slug('UMATA', '-'),
         ]);
    }
}
