<?php

use Illuminate\Database\Seeder;
use App\Producto;
class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        //factory(Producto::class)->times(10)->create();
        Producto::create(['id'=>10101501,'detproducto'=>'Gatos','slug'=>Str::slug('Gatos','-'),'clase_id'=>'101015',]);
        Producto::create(['id'=>10101502,'detproducto'=>'Perros','slug'=>Str::slug('Perros','-'),'clase_id'=>'101016',]);
        Producto::create(['id'=>10101504,'detproducto'=>'Visón','slug'=>Str::slug('Visón','-'),'clase_id'=>'101016',]);
        

    }
}
