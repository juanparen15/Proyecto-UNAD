<?php

use App\Segmento;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class SegmentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        Segmento::create(['id'=>10,'detsegmento'=>'Material Vivo Vegetal y Animal, Accesorios y Suministros','slug'=>Str::slug('Material Vivo Vegetal y Animal, Accesorios y Suministros','-'),]);
        Segmento::create(['id'=>11,'detsegmento'=>'Material Mineral, Textil y  Vegetal y Animal No Comestible','slug'=>Str::slug('Material Mineral, Textil y  Vegetal y Animal No Comestible','-'),]);
        Segmento::create(['id'=>12,'detsegmento'=>'Material Químico incluyendo Bioquímicos y Materiales de Gas','slug'=>Str::slug('Material Químico incluyendo Bioquímicos y Materiales de Gas','-'),]);
        Segmento::create(['id'=>13,'detsegmento'=>'Materiales de Resina, Colofonia, Caucho, Espuma, Película y Elastómericos','slug'=>Str::slug('Materiales de Resina, Colofonia, Caucho, Espuma, Película y Elastómericos','-'),]);
        Segmento::create(['id'=>14,'detsegmento'=>'Materiales y Productos de Papel','slug'=>Str::slug('Materiales y Productos de Papel','-'),]);
        Segmento::create(['id'=>15,'detsegmento'=>'Materiales Combustibles, Aditivos para Combustibles, Lubricantes y Anticorrosivos','slug'=>Str::slug('Materiales Combustibles, Aditivos para Combustibles, Lubricantes y Anticorrosivos','-'),]);
        Segmento::create(['id'=>20,'detsegmento'=>'Maquinaria y Accesorios de Minería y Perforación de Pozos','slug'=>Str::slug('Maquinaria y Accesorios de Minería y Perforación de Pozos','-'),]);
        Segmento::create(['id'=>21,'detsegmento'=>'Maquinaria y Accesorios para Agricultura, Pesca, Silvicultura y Fauna','slug'=>Str::slug('Maquinaria y Accesorios para Agricultura, Pesca, Silvicultura y Fauna','-'),]);
        Segmento::create(['id'=>22,'detsegmento'=>'Maquinaria y Accesorios para Construcción y Edificación','slug'=>Str::slug('Maquinaria y Accesorios para Construcción y Edificación','-'),]);
        Segmento::create(['id'=>23,'detsegmento'=>'Maquinaria y Accesorios para Manufactura y Procesamiento Industrial','slug'=>Str::slug('Maquinaria y Accesorios para Manufactura y Procesamiento Industrial','-'),]);
        Segmento::create(['id'=>24,'detsegmento'=>'Maquinaria, Accesorios y Suministros para Manejo, Acondicionamiento y Almacenamiento de Materiales','slug'=>Str::slug('Maquinaria, Accesorios y Suministros para Manejo, Acondicionamiento y Almacenamiento de Materiales','-'),]);
        Segmento::create(['id'=>25,'detsegmento'=>'Vehículos Comerciales, Militares y Particulares, Accesorios y Componentes','slug'=>Str::slug('Vehículos Comerciales, Militares y Particulares, Accesorios y Componentes','-'),]);
        Segmento::create(['id'=>26,'detsegmento'=>'Maquinaria y Accesorios para Generación y Distribución de Energía','slug'=>Str::slug('Maquinaria y Accesorios para Generación y Distribución de Energía','-'),]);
        Segmento::create(['id'=>27,'detsegmento'=>'Herramientas y Maquinaria General','slug'=>Str::slug('Herramientas y Maquinaria General','-'),]);
        Segmento::create(['id'=>30,'detsegmento'=>'Componentes y Suministros para Estructuras, Edificación, Construcción y Obras Civiles','slug'=>Str::slug('Componentes y Suministros para Estructuras, Edificación, Construcción y Obras Civiles','-'),]);
        Segmento::create(['id'=>31,'detsegmento'=>'Componentes y Suministros de Manufactura','slug'=>Str::slug('Componentes y Suministros de Manufactura','-'),]);
        Segmento::create(['id'=>32,'detsegmento'=>'Componentes y Suministros Electrónicos','slug'=>Str::slug('Componentes y Suministros Electrónicos','-'),]);
        Segmento::create(['id'=>39,'detsegmento'=>'Componentes, Accesorios y Suministros de Sistemas Eléctricos e Iluminación','slug'=>Str::slug('Componentes, Accesorios y Suministros de Sistemas Eléctricos e Iluminación','-'),]);
        Segmento::create(['id'=>40,'detsegmento'=>'Componentes y Equipos para Distribución y Sistemas de Acondicionamiento','slug'=>Str::slug('Componentes y Equipos para Distribución y Sistemas de Acondicionamiento','-'),]);
        Segmento::create(['id'=>41,'detsegmento'=>'Equipos y Suministros de Laboratorio, de Medición, de Observación y de Pruebas','slug'=>Str::slug('Equipos y Suministros de Laboratorio, de Medición, de Observación y de Pruebas','-'),]);
        Segmento::create(['id'=>42,'detsegmento'=>'Equipo Médico, Accesorios y Suministros','slug'=>Str::slug('Equipo Médico, Accesorios y Suministros','-'),]);
        Segmento::create(['id'=>43,'detsegmento'=>'Difusión de Tecnologías de Información y Telecomunicaciones','slug'=>Str::slug('Difusión de Tecnologías de Información y Telecomunicaciones','-'),]);
        Segmento::create(['id'=>44,'detsegmento'=>'Equipos de Oficina, Accesorios y Suministros','slug'=>Str::slug('Equipos de Oficina, Accesorios y Suministros','-'),]);
        Segmento::create(['id'=>45,'detsegmento'=>'Equipos y Suministros para Impresión, Fotografia y Audiovisuales','slug'=>Str::slug('Equipos y Suministros para Impresión, Fotografia y Audiovisuales','-'),]);
        Segmento::create(['id'=>46,'detsegmento'=>'Equipos y Suministros de Defensa, Orden Publico, Proteccion, Vigilancia y Seguridad','slug'=>Str::slug('Equipos y Suministros de Defensa, Orden Publico, Proteccion, Vigilancia y Seguridad','-'),]);
        Segmento::create(['id'=>47,'detsegmento'=>'Equipos de Limpieza y Suministros','slug'=>Str::slug('Equipos de Limpieza y Suministros','-'),]);
        Segmento::create(['id'=>48,'detsegmento'=>'Maquinaria, Equipo y Suministros para la Industria de Servicios','slug'=>Str::slug('Maquinaria, Equipo y Suministros para la Industria de Servicios','-'),]);
        Segmento::create(['id'=>49,'detsegmento'=>'Equipos, Suministros y Accesorios para Deportes y Recreación','slug'=>Str::slug('Equipos, Suministros y Accesorios para Deportes y Recreación','-'),]);
        Segmento::create(['id'=>50,'detsegmento'=>'Alimentos, Bebidas y Tabaco ','slug'=>Str::slug('Alimentos, Bebidas y Tabaco ','-'),]);
        Segmento::create(['id'=>51,'detsegmento'=>'Medicamentos y Productos Farmacéuticos','slug'=>Str::slug('Medicamentos y Productos Farmacéuticos','-'),]);
        Segmento::create(['id'=>52,'detsegmento'=>'Artículos Domésticos, Suministros y Productos Electrónicos de Consumo ','slug'=>Str::slug('Artículos Domésticos, Suministros y Productos Electrónicos de Consumo ','-'),]);
        Segmento::create(['id'=>53,'detsegmento'=>'Ropa, Maletas y Productos de Aseo Personal','slug'=>Str::slug('Ropa, Maletas y Productos de Aseo Personal','-'),]);
        Segmento::create(['id'=>54,'detsegmento'=>'Productos para Relojería, Joyería y Piedras Preciosas','slug'=>Str::slug('Productos para Relojería, Joyería y Piedras Preciosas','-'),]);
        Segmento::create(['id'=>55,'detsegmento'=>'Publicaciones Impresas, Publicaciones Electrónicas y Accesorios','slug'=>Str::slug('Publicaciones Impresas, Publicaciones Electrónicas y Accesorios','-'),]);
        Segmento::create(['id'=>56,'detsegmento'=>'Muebles, Mobiliario y Decoración','slug'=>Str::slug('Muebles, Mobiliario y Decoración','-'),]);
        Segmento::create(['id'=>60,'detsegmento'=>'Instrumentos Musicales, Juegos, Juguetes, Artes, Artesanías y Equipo educativo, Materiales, Accesorios y Suministros','slug'=>Str::slug('Instrumentos Musicales, Juegos, Juguetes, Artes, Artesanías y Equipo educativo, Materiales, Accesorios y Suministros','-'),]);
        Segmento::create(['id'=>70,'detsegmento'=>'Servicios de Contratacion Agrícola, Pesquera, Forestal y de Fauna','slug'=>Str::slug('Servicios de Contratacion Agrícola, Pesquera, Forestal y de Fauna','-'),]);
        
        Segmento::create(['id'=>71,'detsegmento'=>'Servicios de Minería, Petróleo y Gas','slug'=>Str::slug('Servicios de Minería, Petróleo y Gas','-'),]);
        Segmento::create(['id'=>72,'detsegmento'=>'Servicios de Edificación, Construcción de Instalaciones y Mantenimiento','slug'=>Str::slug('Servicios de Edificación, Construcción de Instalaciones y Mantenimiento','-'),]);
        Segmento::create(['id'=>73,'detsegmento'=>'Servicios de Producción Industrial y Manufactura','slug'=>Str::slug('Servicios de Producción Industrial y Manufactura','-'),]);
        Segmento::create(['id'=>76,'detsegmento'=>'Servicios de Limpieza, Descontaminación y Tratamiento de Residuos','slug'=>Str::slug('Servicios de Limpieza, Descontaminación y Tratamiento de Residuos','-'),]);
        Segmento::create(['id'=>77,'detsegmento'=>'Servicios Medioambientales','slug'=>Str::slug('Servicios Medioambientales','-'),]);
        Segmento::create(['id'=>78,'detsegmento'=>'Servicios de Transporte, Almacenaje y Correo','slug'=>Str::slug('Servicios de Transporte, Almacenaje y Correo','-'),]);
        Segmento::create(['id'=>80,'detsegmento'=>'Servicios de Gestión, Servicios Profesionales de Empresa y Servicios Administrativos','slug'=>Str::slug('Servicios de Gestión, Servicios Profesionales de Empresa y Servicios Administrativos','-'),]);
        Segmento::create(['id'=>81,'detsegmento'=>'Servicios Basados en Ingeniería, Investigación y Tecnología','slug'=>Str::slug('Servicios Basados en Ingeniería, Investigación y Tecnología','-'),]);
        Segmento::create(['id'=>82,'detsegmento'=>'Servicios Editoriales, de Diseño, de Artes Graficas y Bellas Artes','slug'=>Str::slug('Servicios Editoriales, de Diseño, de Artes Graficas y Bellas Artes','-'),]);
        Segmento::create(['id'=>83,'detsegmento'=>'Servicios Públicos y Servicios Relacionados con el Sector Público','slug'=>Str::slug('Servicios Públicos y Servicios Relacionados con el Sector Público','-'),]);
        Segmento::create(['id'=>84,'detsegmento'=>'Servicios Financieros y de Seguros','slug'=>Str::slug('Servicios Financieros y de Seguros','-'),]);
        Segmento::create(['id'=>85,'detsegmento'=>'Servicios de Salud','slug'=>Str::slug('Servicios de Salud','-'),]);
        Segmento::create(['id'=>86,'detsegmento'=>'Servicios Educativos y de Formación','slug'=>Str::slug('Servicios Educativos y de Formación','-'),]);
        Segmento::create(['id'=>90,'detsegmento'=>'Servicios de Viajes, Alimentación, Alojamiento y Entretenimiento','slug'=>Str::slug('Servicios de Viajes, Alimentación, Alojamiento y Entretenimiento','-'),]);
        Segmento::create(['id'=>91,'detsegmento'=>'Servicios Personales y Domésticos','slug'=>Str::slug('Servicios Personales y Domésticos','-'),]);
        Segmento::create(['id'=>92,'detsegmento'=>'Servicios de Defensa Nacional, Orden Publico, Seguridad y Vigilancia','slug'=>Str::slug('Servicios de Defensa Nacional, Orden Publico, Seguridad y Vigilancia','-'),]);
        Segmento::create(['id'=>93,'detsegmento'=>'Servicios Políticos y de Asuntos Cívicos','slug'=>Str::slug('Servicios Políticos y de Asuntos Cívicos','-'),]);
        Segmento::create(['id'=>94,'detsegmento'=>'Organizaciones y Clubes','slug'=>Str::slug('Organizaciones y Clubes','-'),]);
        Segmento::create(['id'=>95,'detsegmento'=>'Terrenos, Edificios, Estructuras y Vías','slug'=>Str::slug('Terrenos, Edificios, Estructuras y Vías','-'),]);
        

            
    }
}
