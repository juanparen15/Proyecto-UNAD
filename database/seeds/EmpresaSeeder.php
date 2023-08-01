<?php

use App\Empresa;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empresa::create([
            'nombre'=>'Inventario Documental de la Alcaldia de Puerto Boyaca',
            'mision'=>'El Municipio de Puerto Boyacá es un ente territorial que gestiona, articula y promociona el desarrollo en el ámbito social, político, económico, cultural y ambiental, basado en la democracia participativa e incluyente, empoderando a la comunidad para que asuman compromisos de libertad con orden, responsabilidad ciudadana y solidaria; generando alianzas público-privadas que apoyen el bienestar y la calidad de vida de todas y todos, obedeciendo a mandatos constitucionales.',
            'vision'=>'En el 2023 "PUERTO BOYACÁ PRIMERO" consolidará la cultura ciudadana donde el capital principal serán las personas, fortalecidas en la convivencia, reflejando su orgullo y pujanza, avanzando en la construcción de un territorio equitativo, atractivo y sostenible, en la diversificación economía, mejorando la participación ciudadana y el buen gobierno, y así sentar las bases para convertirse en eje de progreso para la subregión del centro del país..',
            'url'=>'https://www.puertoboyaca-boyaca.gov.co/Paginas/default.aspx'
        ]);
    }
}
