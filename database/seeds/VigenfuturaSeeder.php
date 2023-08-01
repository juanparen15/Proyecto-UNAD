<?php

use App\Vigenfutura;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class VigenfuturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vigenfutura::create([
            'id'=>'1',
            'detvigencia'=>'SI',
            'slug'=>Str::slug('SI', '-'),
        ]);

        Vigenfutura::create([
            'id'=>'2',
            'detvigencia'=>'NO',
            'slug'=>Str::slug('NO', '-'),
        ]);
    }
}
