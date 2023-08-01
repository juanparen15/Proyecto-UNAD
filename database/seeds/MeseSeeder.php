<?php

use App\Mese;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MeseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mese::create([
            'nommes'=>'Enero',
            'slug'=>Str::slug('Enero', '-'),
        ]);

        Mese::create([
            'nommes'=>'Febrero',
            'slug'=>Str::slug('Febrero', '-'),
        ]);
        Mese::create([
            'nommes'=>'Marzo',
            'slug'=>Str::slug('Marzo', '-'),
        ]);
        Mese::create([
            'nommes'=>'Abril',
            'slug'=>Str::slug('Abril', '-'),
        ]);
        Mese::create([
            'nommes'=>'Mayo',
            'slug'=>Str::slug('Mayo', '-'),
        ]);
        Mese::create([
            'nommes'=>'Junio',
            'slug'=>Str::slug('Junio', '-'),
        ]);
        Mese::create([
            'nommes'=>'Julio',
            'slug'=>Str::slug('Julio', '-'),
        ]);
        Mese::create([
            'nommes'=>'Agosto',
            'slug'=>Str::slug('Agosto', '-'),
        ]);
        Mese::create([
            'nommes'=>'Septiembre',
            'slug'=>Str::slug('Septiembre', '-'),
        ]);
        Mese::create([
            'nommes'=>'Octubre',
            'slug'=>Str::slug('Octubre', '-'),
        ]);
        Mese::create([
            'nommes'=>'Noviembre',
            'slug'=>Str::slug('Noviembre', '-'),
        ]);
        Mese::create([
            'nommes'=>'Diciembre',
            'slug'=>Str::slug('Diciembre', '-'),
        ]);
    }
}
