<?php

use App\Tipoadquisicione;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class TipoadquisicioneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipoadquisicione::create([
            'id'=>'1',
            'dettipoadquisicion'=>'Prestación de servicio',
            'slug'=>Str::slug('Prestación de servicio', '-'),
        ]);
        Tipoadquisicione::create([
            'id'=>'2',
            'dettipoadquisicion'=>'Obra pública',
            'slug'=>Str::slug('Obra pública', '-'),
        ]);
        Tipoadquisicione::create([
            'id'=>'3',
            'dettipoadquisicion'=>'Compra de materiales y suministros',
            'slug'=>Str::slug('Compra de materiales y suministros', '-'),
        ]);
        Tipoadquisicione::create([
            'id'=>'4',
            'dettipoadquisicion'=>'Compra de bienes, equipos, muebles y enseres',
            'slug'=>Str::slug('Compra de bienes, equipos, muebles y enseres', '-'),
        ]);
        Tipoadquisicione::create([
            'id'=>'5',
            'dettipoadquisicion'=>'Combustible',
            'slug'=>Str::slug('Combustible', '-'),
        ]);
        Tipoadquisicione::create([
            'id'=>'6',
            'dettipoadquisicion'=>'Mantenimiento y/o reparaciones',
            'slug'=>Str::slug('Mantenimiento y/o reparaciones', '-'),
        ]);
        Tipoadquisicione::create([
            'id'=>'7',
            'dettipoadquisicion'=>'Transporte',
            'slug'=>Str::slug('Transporte', '-'),
        ]);
        Tipoadquisicione::create([
            'id'=>'8',
            'dettipoadquisicion'=>'Alimentación',
            'slug'=>Str::slug('Alimentación', '-'),
        ]);
        Tipoadquisicione::create([
            'id'=>'9',
            'dettipoadquisicion'=>'Comunicación, impresos y publicaciones',
            'slug'=>Str::slug('Comunicación, impresos y publicaciones', '-'),
        ]);
        Tipoadquisicione::create([
            'id'=>'10',
            'dettipoadquisicion'=>'Compra de equipos y servicios TIC',
            'slug'=>Str::slug('Compra de equipos y servicios TIC', '-'),
        ]);
        Tipoadquisicione::create([
            'id'=>'11',
            'dettipoadquisicion'=>'Arriendos y seguros',
            'slug'=>Str::slug('Arriendos y seguros', '-'),
        ]);
        Tipoadquisicione::create([
            'id'=>'12',
            'dettipoadquisicion'=>'Compra de Inmuebles',
            'slug'=>Str::slug('Compra de Inmuebles', '-'),
        ]);
        Tipoadquisicione::create([
            'id'=>'13',
            'dettipoadquisicion'=>'Otros',
            'slug'=>Str::slug('Otros', '-'),
        ]);
    }
}
