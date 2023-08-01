<?php

use App\Tipoproceso;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class TipoprocesoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipoproceso::create([
            'id'=>'1',
            'dettipoproceso'=>'Mínima cuantía ($1 hasta $25 438.728)',
            'slug'=>Str::slug('Mínima cuantía ($1 hasta $25 438.728)', '-'),
        ]);

        Tipoproceso::create([
            'id'=>'2',
            'dettipoproceso'=>'Menor cuantía ($25 438.729 hasta $254 387.280)',
            'slug'=>Str::slug('Menor cuantía ($25 438.729 hasta $254 387.280)', '-'),
        ]);

        Tipoproceso::create([
            'id'=>'3',
            'dettipoproceso'=>'Mayor cuantía (Superiores a $254 387.280)',
            'slug'=>Str::slug('Mayor cuantía (Superiores a $254 387.280)', '-'),
        ]);
    }
}
