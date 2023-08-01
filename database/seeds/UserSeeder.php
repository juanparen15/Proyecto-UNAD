<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = Role::create(['name' => 'Admin']);
        $user_role = Role::create(['name' => 'User']);
        
        Permission::create(['name' => 'admin.areas.index']);
        Permission::create(['name' => 'admin.areas.store']);
        Permission::create(['name' => 'admin.areas.create']);
        Permission::create(['name' => 'admin.areas.update']);
        Permission::create(['name' => 'admin.areas.destroy']);
        Permission::create(['name' => 'admin.areas.edit']);
        Permission::create(['name' => 'admin.clases.store']); 
        Permission::create(['name' => 'admin.clases.index']);
        Permission::create(['name' => 'admin.clases.create']); 
        Permission::create(['name' => 'admin.clases.update']);
        Permission::create(['name' => 'admin.clases.destroy']);
        Permission::create(['name' => 'admin.clases.edit']);
        Permission::create(['name' => 'admin.dependencias.index']);
        Permission::create(['name' => 'admin.dependencias.store']);
        Permission::create(['name' => 'admin.dependencias.create']);
        Permission::create(['name' => 'admin.dependencias.destroy']);
        Permission::create(['name' => 'admin.dependencias.update']);
        Permission::create(['name' => 'admin.dependencias.edit']);
        Permission::create(['name' => 'admin.estadovigencias.index']);
        Permission::create(['name' => 'admin.estadovigencias.store']);
        Permission::create(['name' => 'admin.estadovigencias.create']);
        Permission::create(['name' => 'admin.estadovigencias.update']);
        Permission::create(['name' => 'admin.estadovigencias.destroy']);
        Permission::create(['name' => 'admin.estadovigencias.edit']);
        Permission::create(['name' => 'admin.familias.index']);
        Permission::create(['name' => 'admin.familias.store']);
        Permission::create(['name' => 'admin.familias.create']);
        Permission::create(['name' => 'admin.familias.update']);
        Permission::create(['name' => 'admin.familias.destroy']);
        Permission::create(['name' => 'admin.familias.edit']); 
        Permission::create(['name' => 'admin.fuentes.store']);
        Permission::create(['name' => 'admin.fuentes.index']);
        Permission::create(['name' => 'admin.fuentes.create']);
        Permission::create(['name' => 'admin.fuentes.destroy']);
        Permission::create(['name' => 'admin.fuentes.update']);
        Permission::create(['name' => 'admin.fuentes.edit']);
        Permission::create(['name' => 'admin.meses.index']);
        Permission::create(['name' => 'admin.modalidades.store']);
        Permission::create(['name' => 'admin.modalidades.index']);
        Permission::create(['name' => 'admin.modalidades.create']);
        Permission::create(['name' => 'admin.modalidades.update']);
        Permission::create(['name' => 'admin.modalidades.destroy']);
        Permission::create(['name' => 'admin.modalidades.edit']);


        Permission::create(['name' => 'admin.productos.store']);
        Permission::create(['name' => 'admin.productos.index']);
        Permission::create(['name' => 'admin.productos.create']); 
        Permission::create(['name' => 'admin.productos.update']);
        Permission::create(['name' => 'admin.productos.destroy']);
        Permission::create(['name' => 'admin.productos.edit']);
        Permission::create(['name' => 'admin.proyectos.store']);
        Permission::create(['name' => 'admin.proyectos.index']);
        Permission::create(['name' => 'admin.proyectos.create']);
        Permission::create(['name' => 'admin.proyectos.update']);
        Permission::create(['name' => 'admin.proyectos.destroy']);
        Permission::create(['name' => 'admin.proyectos.edit']);
        Permission::create(['name' => 'retirar_producto']);
        Permission::create(['name' => 'admin.segmentos.store']);
        Permission::create(['name' => 'admin.segmentos.index']); 
        Permission::create(['name' => 'admin.segmentos.create']);
        Permission::create(['name' => 'admin.segmentos.update']);
        Permission::create(['name' => 'admin.segmentos.destroy']);
        Permission::create(['name' => 'admin.segmentos.edit']);
        Permission::create(['name' => 'admin.tipoadquicsiciones.index']);
        Permission::create(['name' => 'admin.tipoprioridades.store']);
        Permission::create(['name' => 'admin.tipoprioridades.index']); 
        Permission::create(['name' => 'admin.tipoprioridades.create']);
        Permission::create(['name' => 'admin.tipoprioridades.destroy']);
        Permission::create(['name' => 'admin.tipoprioridades.update']);
        Permission::create(['name' => 'admin.tipoprioridades.edit']);
        Permission::create(['name' => 'admin.tipoprocesos.store']);
        Permission::create(['name' => 'admin.tipoprocesos.index']);
        Permission::create(['name' => 'admin.tipoprocesos.create']);
        Permission::create(['name' => 'admin.tipoprocesos.update']);
        Permission::create(['name' => 'admin.tipoprocesos.destroy']);
        Permission::create(['name' => 'admin.tipoprocesos.edit']);
        Permission::create(['name' => 'tipozonas.index']);

        
       
        Permission::create(['name' => 'planadquisiciones.index']);
        Permission::create(['name' => 'planadquisiciones.store']);
        Permission::create(['name' => 'planadquisiciones.create']);
        Permission::create(['name' => 'planadquisiciones.show']);
        Permission::create(['name' => 'planadquisiciones.destroy']);
        Permission::create(['name' => 'planadquisiciones.update']);
        Permission::create(['name' => 'planadquisiciones.edit']);
        // new
        Permission::create(['name' => 'planadquisiciones.export']);
        

        Permission::create(['name' => 'exportar_planadquisiciones_excel']);
        Permission::create(['name' => 'agregar_producto']);

        $admin->syncPermissions([
            'admin.areas.index',
            'admin.areas.store',
            'admin.areas.create',
            'admin.areas.update',
            'admin.areas.destroy',
            'admin.areas.edit',
            'admin.clases.store', 
            'admin.clases.index',
            'admin.clases.create', 
            'admin.clases.update',
            'admin.clases.destroy',
            'admin.clases.edit',
            'admin.dependencias.index',
            'admin.dependencias.store',
            'admin.dependencias.create',
            'admin.dependencias.destroy',
            'admin.dependencias.update',
            'admin.dependencias.edit',
            'admin.estadovigencias.index',
            'admin.estadovigencias.store',
            'admin.estadovigencias.create',
            'admin.estadovigencias.update',
            'admin.estadovigencias.destroy',
            'admin.estadovigencias.edit',
            'admin.familias.index',
            'admin.familias.store',
            'admin.familias.create',
            'admin.familias.update',
            'admin.familias.destroy',
            'admin.familias.edit', 
            'admin.fuentes.store',
            'admin.fuentes.index',
            'admin.fuentes.create',
            'admin.fuentes.destroy',
            'admin.fuentes.update',
            'admin.fuentes.edit',
            'admin.meses.index',
            'admin.modalidades.store',
            'admin.modalidades.index',
            'admin.modalidades.create',
            'admin.modalidades.update',
            'admin.modalidades.destroy',
            'admin.modalidades.edit',
            'admin.productos.store',
            'admin.productos.index',
            'admin.productos.create', 
            'admin.productos.update',
            'admin.productos.destroy',
            'admin.productos.edit',
            'admin.proyectos.store',
            'admin.proyectos.index',
            'admin.proyectos.create',
            'admin.proyectos.update',
            'admin.proyectos.destroy',
            'admin.proyectos.edit',
            'admin.segmentos.store',
            'admin.segmentos.index', 
            'admin.segmentos.create',
            'admin.segmentos.update',
            'admin.segmentos.destroy',
            'admin.segmentos.edit',
            'admin.tipoadquicsiciones.index',
            'admin.tipoprioridades.store',
            'admin.tipoprioridades.index', 
            'admin.tipoprioridades.create',
            'admin.tipoprioridades.destroy',
            'admin.tipoprioridades.update',
            'admin.tipoprioridades.edit',
            'admin.tipoprocesos.store',
            'admin.tipoprocesos.index',
            'admin.tipoprocesos.create',
            'admin.tipoprocesos.update',
            'admin.tipoprocesos.destroy',
            'admin.tipoprocesos.edit',
            'tipozonas.index',

            'planadquisiciones.export',

            'planadquisiciones.index',
            'planadquisiciones.show',
            'exportar_planadquisiciones_excel'
        ]);
        $user_role->syncPermissions([
            'planadquisiciones.index',
            'planadquisiciones.store',
            'planadquisiciones.create',
            'planadquisiciones.show',
            'planadquisiciones.destroy',
            'planadquisiciones.update',
            'planadquisiciones.edit',

            'planadquisiciones.export',
            'exportar_planadquisiciones_excel',

            'retirar_producto',
            'agregar_producto'
        ]);

        $user_admin = User::create([
            'name'=>'Fabian Murillo Marin',
            'email'=>'ticsistemasptoboy@gmail.com',
            'password' =>bcrypt('sistemas2021*a')
        ])->assignRole('Admin');

        $user_user = User::create([
            'name'=>'Oficina de Sistemas',
            'email'=>'sistemas@puertoboyaca-boyaca.gov.co',
            'password' =>bcrypt('sistemas2021*')
        ])->assignRole('User');

        $user_user = User::create([
            'name'=>'Oficina de Control Interno',
            'email'=>'controlinterno@puertoboyaca-boyaca.gov.co',
            'password' =>bcrypt('controlinterno2021*')
        ])->assignRole('User');
        $user_user = User::create([
            'name'=>'Área de Almacén',
            'email'=>'almacenmunicipal@puertoboyaca-boyaca.gov.co',
            'password' =>bcrypt('almacen2021*')    
        ])->assignRole('User');

        $user_user = User::create([
            'name'=>'Área De Personal',
            'email'=>'personal@puertoboyaca-boyaca.gov.co',
            'password' =>bcrypt('personal2021*')    
        ])->assignRole('User');

        $user_user = User::create([
            'name'=>'Área De Archivo',
            'email'=>'archivomunicipal@puertoboyaca-boyaca.gov.co',
            'password' =>bcrypt('archivo2021*')    
        ])->assignRole('User');

        $user_user = User::create([
            'name'=>'Área De Vivienda',
            'email'=>'vivienda@puertoboyaca-boyaca.gov.co',
            'password' =>bcrypt('vivienda2021*')    
        ])->assignRole('User');

        $user_user = User::create([
            'name'=>'Área De Salud',
            'email'=>'salud@puertoboyaca-boyaca.gov.co',
            'password' =>bcrypt('salud2021*')    
        ])->assignRole('User');

        $user_user = User::create([
            'name'=>'Comisaria De Familia',
            'email'=>'comisariadefamilia@puertoboyaca-boyaca.gov.co',
            'password' =>bcrypt('comisariafamilia2021*')    
        ])->assignRole('User');

        $user_user = User::create([
            'name'=>'Área De Cultura',
            'email'=>'cultura@puertoboyaca-boyaca.gov.co',
            'password' =>bcrypt('cultura2021*')    
        ])->assignRole('User');

        $user_user = User::create([
            'name'=>'Cuerpo De Bomberos',
            'email'=>'bomberos@puertoboyaca-boyaca.gov.co',
            'password' =>bcrypt('bomberos2021*')    
        ])->assignRole('User');

        $user_user = User::create([
            'name'=>'Biblioteca Pública Municipal',
            'email'=>'biblioteca@puertoboyaca-boyaca.gov.co',
            'password' =>bcrypt('biblioteca2021*')    
        ])->assignRole('User');
       
      
        

        //factory(User::class)->times(10)->create();
    }
}
