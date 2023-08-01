<?php

use Illuminate\Database\Seeder;
use App\Clase;
class ClaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(Clase::class)->times(10)->create();
        Clase::create(['id'=>101015,'detclase'=>'Animales de granja','slug'=>Str::slug('Animales de granja','-'),'familia_id'=>'1010',]);
        Clase::create(['id'=>101016,'detclase'=>'Pájaros y aves de corral','slug'=>Str::slug('Pájaros y aves de corral','-'),'familia_id'=>'1010',]);

    }
}
