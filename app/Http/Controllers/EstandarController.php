<?php

namespace App\Http\Controllers;

use App\Estandar;
use App\Ciudad;
use Illuminate\Http\Request;
use App\Http\Requests\estandar\StoreRequest;
use App\Http\Requests\estandar\UpdateRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class EstandarController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin'); 
        // $this->middleware([
        //     'permission:admin.estandares.index',
        //     'permission:admin.estandares.store',
        //     'permission:admin.estandares.create',
        //     'permission:admin.estandares.update',
        //     'permission:admin.estandares.destroy',
        //     'permission:admin.estandares.edit'
        // ]);
    }
    public function index()
    {
        $estandares = Estandar::get();
        return view('admin.estandares.index', compact('estandares'));
    }

    public function create()
    {
        $ciudades =  Ciudad::get();
        return view('admin.estandares.create', compact('ciudades'));
    }

    public function store(StoreRequest $request)
    {
        $slug = Str::slug($request->detestandar);

        // Verificar si ya existe un Inventario con el mismo slug
        $counter = 1;
        while (Estandar::where('slug', $slug)->exists()) {
            $slug = Str::slug($request->detestandar . '-' . $counter, '-');
            $counter++;
        }
        // Obtén el último ID en la tabla y agrega 1 para generar un número de orden único
        $ultimoId = Estandar::max('id') + 1;

        $slugWithId = $slug . '-' . $ultimoId;


        // Crear el estándar en la base de datos
        $estandar = Estandar::create([
            'detestandar' => $request->detestandar,
            'slug' => $slugWithId,
            'ciudad_id' => $request->ciudad_id
        ]);

        // Obtener el nombre de la ciudad utilizando el ID
        $nombreCiudad = Ciudad::findOrFail($request->ciudad_id)->detciudad;

        // Crear la carpeta para el estándar de la ciudad utilizando el nombre ingresado
        $carpetaEstandar = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $request->detestandar;

        // Verificar si la carpeta no existe y luego crearla
        if (!File::exists($carpetaEstandar)) {
            File::makeDirectory($carpetaEstandar, 0777, true);
        }
        return redirect()->route('admin.estandares.index')->with('flash', 'registrado');
    }


    public function show(Estandar $estandar)
    {
        return view('admin.estandares.show', compact('estandar'));
    }

    public function edit(Estandar $estandar)
    {
        $ciudades = Ciudad::get();
        // $estandar->load('ciudad');
        return view('admin.estandares.edit', compact('estandar', 'ciudades'));
    }


    public function update(UpdateRequest $request, Estandar $estandar)
    {
        $slug = Str::slug($request->detestandar);

        // Verificar si el nuevo slug ya existe para otro registro
        $counter = 1;
        while (Estandar::where('slug', $slug)->where('id', '<>', $estandar->id)->exists()) {
            $slug = $slug . '-' . $counter;
            $counter++;
        }

        // Obtén el último ID en la tabla y agrega 1 para generar un número de orden único
        $ultimoId = Estandar::max('id');

        $slugWithId = $slug . '-' . $ultimoId;

        // Guardar el nombre anterior del estándar
        $oldEstandarName = $estandar->detestandar;

        // dd($oldEstandarName);

        // Actualizar los datos del estándar en la base de datos
        $estandar->update([
            'detestandar' => $request->detestandar,
            'slug' => $slugWithId,
            'ciudad_id' => $request->ciudad_id,
        ]);

        // Verificar si el nombre del estándar ha cambiado
        if ($oldEstandarName !== $request->detestandar) {
            // Obtener el nombre de la ciudad utilizando el ID
            $nombreCiudad = Ciudad::findOrFail($request->ciudad_id)->detciudad;

            // Renombrar la carpeta del estándar
            $oldFolderPath = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $oldEstandarName;
            $newFolderPath = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $request->detestandar;

            if (File::exists($oldFolderPath)) {
                File::move($oldFolderPath, $newFolderPath);
            }
        }
        return redirect()->route('admin.estandares.index')->with('flash', 'actualizado');
    }

    public function destroy(Estandar $estandar)
    {
        // Obtener el nombre de la ciudad utilizando el ID del estándar
        $nombreCiudad = $estandar->ciudad->detciudad;

        // Ruta de la carpeta asociada al estándar
        $folderPath = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $estandar->detestandar;

        // Verificar si la carpeta existe antes de intentar eliminarla
        if (File::exists($folderPath)) {
            // Eliminar la carpeta asociada al estándar
            File::deleteDirectory($folderPath);
        }

        // Eliminar el estándar de la base de datos
        $estandar->delete();

        return redirect()->route('admin.estandares.index')->with('flash', 'eliminado');
    }
}
