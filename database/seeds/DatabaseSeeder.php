<?php

use Illuminate\Database\Seeder;
use App\Dependencia;
use App\Fuente;
use App\Modalidade;
use App\Requipoai;
use App\Mese; 
use App\Requiproyecto;
use App\Segmento;
use App\Tipoadquisicione;
use App\Tipoprioridade;
use App\Tipoproceso;
use App\Tipozona;
use App\Vigenfutura;
use App\Estadovigencia;
use App\User;

class DatabaseSeeder extends Seeder
{    
    public function run()
    {
         $this->call(UserSeeder::class); 
         $this->call(DependenciaSeeder::class);
         $this->call(AreaSeeder::class);
         $this->call(FuenteSeeder::class);
         $this->call(EstadovigenciaSeeder::class);
         $this->call(ModalidadeSeeder::class);
         $this->call(TipoprocesoSeeder::class);
         $this->call(TipozonaSeeder::class);
         $this->call(TipoprioridadeSeeder::class);
         $this->call(TipoadquisicioneSeeder::class);         
         $this->call(RequipoaiSeeder::class);
         $this->call(RequiproyectoSeeder::class);
         $this->call(MeseSeeder::class);
         $this->call(VigenfuturaSeeder::class);         
         $this->call(SegmentoSeeder::class);
         $this->call(FamiliaSeeder::class);
         $this->call(ClaseSeeder::class);
         $this->call(ProductoSeeder::class);          
         $this->call(EmpresaSeeder::class);
     
        
    }
}
