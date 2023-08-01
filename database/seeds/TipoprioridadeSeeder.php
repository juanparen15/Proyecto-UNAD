<?php

use App\Tipoprioridade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class TipoprioridadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipoprioridade::create([
            'id'=>'1',
            'detprioridad'=>'Alta',
            'slug'=>Str::slug('Alta', '-'),
        ]);

        Tipoprioridade::create([
            'id'=>'2',
            'detprioridad'=>'Media',
            'slug'=>Str::slug('Media', '-'),
        ]);
        Tipoprioridade::create([
            'id'=>'3',
            'detprioridad'=>'Baja',
            'slug'=>Str::slug('Baja', '-'),
        ]);
    }
}
