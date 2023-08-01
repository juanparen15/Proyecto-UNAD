<?php

use App\Fuente;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class FuenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        Fuente::create([
            'detfuente'=>'Recursos propios',
            'slug'=>Str::slug('Recursos propios', '-'),
        ]);

        Fuente::create([
            'detfuente'=>'Recursos de crédito',
            'slug'=>Str::slug('Recursos de crédito', '-'),
        ]);
        Fuente::create([
            'detfuente'=>'Sistema General de Participaciones - SGP',
            'slug'=>Str::slug('Sistema General de Participaciones - SGP', '-'),
        ]);
        Fuente::create([
            'detfuente'=>'Sistema General de Regalías - SGR',
            'slug'=>Str::slug('Sistema General de Regalías - SGR', '-'),
        ]);
        Fuente::create([
            'detfuente'=>'Presupuesto General de la Nación – PGN',
            'slug'=>Str::slug('Presupuesto General de la Nación – PGN', '-'),
        ]);
        Fuente::create([
            'detfuente'=>'Recursos Propios (Alcaldías, Gobernaciones y Resguardos Indígenas)',
            'slug'=>Str::slug('Recursos Propios (Alcaldías, Gobernaciones y Resguardos Indígenas)', '-'),
        ]);
        Fuente::create([
            'detfuente'=>'Recursos en especie',
            'slug'=>Str::slug('Recursos en especie', '-'),
        ]);
        Fuente::create([
            'detfuente'=>'Recursos privados/cooperación',
            'slug'=>Str::slug('Recursos privados/cooperación', '-'),
        ]);
        Fuente::create([
            'detfuente'=>'Otros recursos',
            'slug'=>Str::slug('Otros recursos', '-'),
        ]);
        Fuente::create([
            'detfuente'=>'Asignación Especial del Sistema General de Participación para Resguardos Indígenas - AESGPRI',
            'slug'=>Str::slug('Asignación Especial del Sistema General de Participación para Resguardos Indígenas - AESGPRI', '-'),
        ]);

    }
}
