<?php

use App\Modalidade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ModalidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Modalidade::create([
            'detmodalidad'=>'LICITACION',
            'slug'=>Str::slug('LICITACION', '-'),
        ]);

        Modalidade::create([
            'detmodalidad'=>'REGIMEN_ESPECIAL',
            'slug'=>Str::slug('REGIMEN_ESPECIAL', '-'),
        ]);
        Modalidade::create([
            'detmodalidad'=>'SUBASTA',
            'slug'=>Str::slug('SUBASTA', '-'),
        ]);
        Modalidade::create([
            'detmodalidad'=>'CONCURSO_MERITOS',
            'slug'=>Str::slug('CONCURSO_MERITOS', '-'),
        ]);
        Modalidade::create([
            'detmodalidad'=>'SELECCION_ABREVIADA',
            'slug'=>Str::slug('SELECCION_ABREVIADA', '-'),
        ]);
        Modalidade::create([
            'detmodalidad'=>'CONTRATACION_DIRECTA',
            'slug'=>Str::slug('CONTRATACION_DIRECTA', '-'),
        ]);
        Modalidade::create([
            'detmodalidad'=>'CONTRATACION_MINIMA_CUANTIA',
            'slug'=>Str::slug('CONTRATACION_MINIMA_CUANTIA', '-'),
        ]);
        Modalidade::create([
            'detmodalidad'=>'CONCURSO_MERITOS_ABIERTO',
            'slug'=>Str::slug('CONCURSO_MERITOS_ABIERTO', '-'),
        ]);
        Modalidade::create([
            'detmodalidad'=>'PROCESOS_SALUD',
            'slug'=>Str::slug('PROCESOS_SALUD', '-'),
        ]);
        Modalidade::create([
            'detmodalidad'=>'SELECCION_ABREVIADA_LIT_H_NUM_2_ART_2_LEY_1150_DE_2007',
            'slug'=>Str::slug('SELECCION_ABREVIADA_LIT_H_NUM_2_ART_2_LEY_1150_DE_2007', '-'),
        ]);
        Modalidade::create([
            'detmodalidad'=>'ASOCIACION_PUBLICO_PRIVADA',
            'slug'=>Str::slug('ASOCIACION_PUBLICO_PRIVADA', '-'),
        ]);
        Modalidade::create([
            'detmodalidad'=>'ASOCIACION_PUBLICO_PRIVADA_INICIATIVA_PRIVADA',
            'slug'=>Str::slug('ASOCIACION_PUBLICO_PRIVADA_INICIATIVA_PRIVADA', '-'),
        ]);
        Modalidade::create([
            'detmodalidad'=>'LICITACION OBRA PUBLICA',
            'slug'=>Str::slug('LICITACION OBRA PUBLICA', '-'),
        ]);
        Modalidade::create([
            'detmodalidad'=>'CONTRATOS Y CONVENIOS CON MAS DE DOS PARTES',
            'slug'=>Str::slug('CONTRATOS Y CONVENIOS CON MAS DE DOS PARTES', '-'),
        ]);
    }
}
