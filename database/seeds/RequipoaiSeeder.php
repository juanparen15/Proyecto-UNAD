<?php

use App\Requipoai;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class RequipoaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Requipoai::create([
            'detpoai'=>'SI',
            'slug'=>Str::slug('SI', '-'),
        ]);

        Requipoai::create([
            'detpoai'=>'NO',
            'slug'=>Str::slug('NO', '-'),
        ]);
    }
}
