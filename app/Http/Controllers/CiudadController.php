<?php

namespace App\Http\Controllers;

use App\Ciudad;
use Illuminate\Http\Request;
use App\Http\Requests\Ciudad\StoreRequest;
use App\Http\Requests\Ciudad\UpdateRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CiudadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin'); 
        // $this->middleware([
        //     'permission:admin.ciudades.store',
        //     'permission:admin.ciudades.index',
        //     'permission:admin.ciudades.create',
        //     'permission:admin.ciudades.update',
        //     'permission:admin.ciudades.destroy',
        //     'permission:admin.ciudades.edit'
        // ]);
    }
    public function index()
    {
        $ciudades = Ciudad::get();
        return view('admin.ciudades.index', compact('ciudades'));
    }


    public function create()
    {
        return view('admin.ciudades.create');
    }


    public function store(StoreRequest $request)
    {

        $slug = Str::slug($request->detciudad);

        // Verificar si ya existe un Inventario con el mismo slug
        $counter = 1;
        while (Ciudad::where('slug', $slug)->exists()) {
            $slug = Str::slug($request->detciudad . '-' . $counter, '-');
            $counter++;
        }
        // Obtén el último ID en la tabla y agrega 1 para generar un número de orden único
        $ultimoId = Ciudad::max('id') + 1;

        $slugWithId = $slug . '-' . $ultimoId;

        // Crear la ciudad en la base de datos
        $ciudad = Ciudad::create([
            'detciudad' => $request->detciudad,
            'slug' => $slugWithId
        ]);

        // Crear la carpeta para la ciudad utilizando el nombre ingresado
        $carpetaCiudad = public_path() . '/adminlte/simulaciones/' . $request->detciudad;

        // Verificar si la carpeta no existe y luego crearla
        if (!File::exists($carpetaCiudad)) {
            File::makeDirectory($carpetaCiudad, 0777, true);
        }

        return redirect()->route('admin.ciudades.index')->with('flash', 'registrado');
    }


    public function show(Ciudad $ciudad)
    {
        return view('admin.ciudades.show', compact('ciudad'));
    }

    public function edit(Ciudad $ciudade)
    {
        return view('admin.ciudades.edit', compact('ciudade'));
    }


    public function update(UpdateRequest $request, Ciudad $ciudade)
    {

        $slug = Str::slug($request->detciudad);

        // Verificar si el nuevo slug ya existe para otro registro
        $counter = 1;
        while (Ciudad::where('slug', $slug)->where('id', '<>', $ciudade->id)->exists()) {
            $slug = $slug . '-' . $counter;
            $counter++;
        }

        // Obtén el último ID en la tabla y agrega 1 para generar un número de orden único
        $ultimoId = Ciudad::max('id');

        $slugWithId = $slug . '-' . $ultimoId;

        // Obtiene el nombre antiguo de la ciudad antes de la actualización
        $oldCiudad = $ciudade->detciudad;

        // Actualiza la ciudad en la base de datos
        $ciudade->update([
            'detciudad' => $request->detciudad,
            'slug' => $slugWithId
        ]);

        // Verifica si el nombre de la ciudad ha cambiado
        if ($oldCiudad !== $ciudade->detciudad) {
            // Renombra la carpeta asociada a la ciudad
            $oldFolderPath = public_path() . '/adminlte/simulaciones/' . $oldCiudad;
            $newFolderPath = public_path() . '/adminlte/simulaciones/' . $ciudade->detciudad;

            if (File::exists($oldFolderPath)) {
                File::move($oldFolderPath, $newFolderPath);
            }
        }

        return redirect()->route('admin.ciudades.index')->with('flash', 'actualizado');
    }


    public function destroy(Ciudad $ciudade)
    {
        // Ruta de la carpeta asociada a la ciudad
        $folderPath = public_path() . '/adminlte/simulaciones/' . $ciudade->detciudad;

        // Verificar si la carpeta existe antes de intentar eliminarla
        if (File::exists($folderPath)) {
            // Eliminar la carpeta asociada a la ciudad
            File::deleteDirectory($folderPath);

            // Eliminar la ciudad de la base de datos
            $ciudade->delete();
        }
        return redirect()->route('admin.ciudades.index')->with('flash', 'eliminado');
    }
}
