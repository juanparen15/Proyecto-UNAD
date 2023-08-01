<?php

use App\Estadovigencia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class EstadovigenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estadovigencia::create([
            'detestadovigencia'=>'NA',
            'slug'=>Str::slug('NA', '-'),
        ]);
        Estadovigencia::create([
            'detestadovigencia'=>'No solicitadas',
            'slug'=>Str::slug('No solicitadas', '-'),
        ]);
        Estadovigencia::create([
            'detestadovigencia'=>'Solicitadas',
            'slug'=>Str::slug('Solicitadas', '-'),
        ]);
        Estadovigencia::create([
            'detestadovigencia'=>'Aprobadas',
            'slug'=>Str::slug('Aprobadas', '-'),
        ]);
    }
}
