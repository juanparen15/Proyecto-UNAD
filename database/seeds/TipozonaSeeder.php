<?php

use App\Tipozona;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class TipozonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipozona::create([
            'id'=>'1',
            'tipozona'=>'Urbana',
            'slug'=>Str::slug('Urbana', '-'),
        ]);
        Tipozona::create([
            'id'=>'2',
            'tipozona'=>'Rural',
            'slug'=>Str::slug('Rural', '-'),
        ]);
        Tipozona::create([
            'id'=>'3',
            'tipozona'=>'Urbana/rural',
            'slug'=>Str::slug('Urbana/rural', '-'),
        ]);
    }
}
