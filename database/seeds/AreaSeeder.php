<?php

use Illuminate\Database\Seeder;
use App\Area;
use Illuminate\Support\Str;
class AreaSeeder extends Seeder
{
   
    public function run()
    {      
        //factory(Area::class)->times(10)->create();
        Area::create([
            'nomarea'=>'Área de Almacén',
            'slug'=>'Área de Almacén',
            'dependencia_id'=>'5',
            ]);
    
            Area::create([
                'nomarea'=>'Área De Sistemas',
                'slug'=>'Área De Sistemas',
                'dependencia_id'=>'5',
            ]);
    
            Area::create([
                'nomarea'=>'Área De Personal',
                'slug'=>'Área De Personal',
                'dependencia_id'=>'5',
            ]);
    
            Area::create([
                'nomarea'=>'Área De Archivo',
                'slug'=>'Área De Archivo',
                'dependencia_id'=>'5',
            ]);
    
            Area::create([
                'nomarea'=>'Área De Vivienda',
                'slug'=>'Área De Vivienda',
                'dependencia_id'=>'8',
            ]);
    
            Area::create([
                'nomarea'=>'Área De Salud',
                'slug'=>'Área De Salud',
                'dependencia_id'=>'4',
            ]);
            
            Area::create([
                'nomarea'=>'Comisaria De Familia',
                'slug'=>'Comisaria De Familia',
                'dependencia_id'=>'3',
            ]);
    
            Area::create([
                'nomarea'=>'Área De Cultura',
                'slug'=>'Área De Cultura',
                'dependencia_id'=>'4',
            ]);
    
            Area::create([
                'nomarea'=>'Cuerpo De Bomberos',
                'slug'=>'Cuerpo De Bomberos',
                'dependencia_id'=>'3',
            ]);      
    
            Area::create([
                'nomarea'=>'Biblioteca Pública Municipal',
                'slug'=>'Biblioteca Pública Municipal',
                'dependencia_id'=>'4',
            ]);
            
            Area::create([
                'nomarea'=>'No Aplica',
                'slug'=>'No Aplica',
                //'dependencia_id'=>
            ]);
    }
}
