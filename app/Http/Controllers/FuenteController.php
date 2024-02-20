<?php

namespace App\Http\Controllers;

use App\Ciudad;
use App\Emisora;
use App\Estandar;
use App\Fuente;
use Illuminate\Http\Request;
use App\Http\Requests\Fuente\StoreRequest;
use App\Http\Requests\Fuente\UpdateRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class FuenteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware([
            'permission:admin.fuentes.store',
            'permission:admin.fuentes.index',
            'permission:admin.fuentes.create',
            'permission:admin.fuentes.destroy',
            'permission:admin.fuentes.update',
            'permission:admin.fuentes.edit'
        ]);
    }
    public function index()
    {
        $fuentes = Fuente::get();
        return view('admin.fuentes.index', compact('fuentes'));
    }


    public function create(Fuente $fuente)
    {
        $ciudades = Ciudad::get();
        $estandares = Estandar::get();
        $fuentes = Fuente::get();
        $emisoras = Emisora::get();

        return view('admin.fuentes.create', compact('estandares', 'ciudades', 'fuentes', 'emisoras', 'fuente'));
    }

    public function store(StoreRequest $request)
    {

        $slug = Str::slug($request->detfuente);

        // Verificar si ya existe un Inventario con el mismo slug
        $counter = 1;
        while (Fuente::where('slug', $slug)->exists()) {
            $slug = Str::slug($request->detfuente . '-' . $counter, '-');
            $counter++;
        }
        // Obtén el último ID en la tabla y agrega 1 para generar un número de orden único
        $ultimoId = Fuente::max('id') + 1;

        $slugWithId = $slug . '-' . $ultimoId;


        $tipoemisora = Fuente::create([
            'detfuente' => $request->detfuente,
            'slug' => $slugWithId,
            'estandar_id' => $request->estandar_id
        ]);


        // Obtener el nombre de la ciudad utilizando el ID
        $nombreCiudad = Ciudad::findOrFail($request->ciudad_id)->detciudad;
        $nombreEstandar = Estandar::findOrFail($request->estandar_id)->detestandar;

        // Crear la carpeta para el estándar de la ciudad utilizando el nombre ingresado
        $carpetaFuente = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $nombreEstandar . '/' . $request->detfuente;

        // Verificar si la carpeta no existe y luego crearla
        if (!File::exists($carpetaFuente)) {
            File::makeDirectory($carpetaFuente, 0777, true);
        }
        return redirect()->route('admin.fuentes.index')->with('flash', 'registrado');
    }


    public function show(Fuente $fuente)
    {
        $ciudades = Ciudad::get();
        $estandares = Estandar::get();
        $fuentes = Fuente::get();
        $emisoras = Emisora::get();

        return view('admin.fuentes.show', compact('estandares', 'ciudades', 'fuentes', 'emisoras', 'fuente'));
    }


    public function edit(Fuente $soporte)
    {
        return view('admin.fuentes.edit', compact('soporte'));
    }


    public function update(UpdateRequest $request, Fuente $soporte)
    {
        $slug = Str::slug($request->detfuente);

        // Verificar si el nuevo slug ya existe para otro registro
        $counter = 1;
        while (Fuente::where('slug', $slug)->where('id', '<>', $soporte->id)->exists()) {
            $slug = $slug . '-' . $counter;
            $counter++;
        }

        // Obtén el último ID en la tabla y agrega 1 para generar un número de orden único
        $ultimoId = Fuente::max('id');

        $slugWithId = $slug . '-' . $ultimoId;

        // Guardar el nombre anterior del estándar
        $oldTipoEmisoraName = $soporte->detfuente;


        $soporte->update([
            'detfuente' => $request->detfuente,
            'slug' => $slugWithId,
            'estandar_id' => $request->estandar_id
        ]);

        // Verificar si el nombre del estándar ha cambiado
        if ($oldTipoEmisoraName !== $request->detfuente) {
            // Obtener el nombre de la ciudad utilizando el ID
            $nombreCiudad = Ciudad::findOrFail($request->ciudad_id)->detciudad;
            $nombreEstandar = Estandar::findOrFail($request->estandar_id)->detestandar;

            // Renombrar la carpeta del estándar
            $oldFolderPath = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $nombreEstandar . '/' . $oldTipoEmisoraName;
            $newFolderPath = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $nombreEstandar . '/' . $request->detfuente;

            if (File::exists($oldFolderPath)) {
                File::move($oldFolderPath, $newFolderPath);
            }
        }
        return redirect()->route('admin.fuentes.index')->with('flash', 'actualizado');
    }

    public function destroy(Fuente $soporte)
    {

        // Obtener el nombre de la ciudad utilizando el ID del estándar
        $nombreCiudad = $soporte->estandar->ciudad->detciudad;
        $nombreEstandar = $soporte->estandar->detestandar;

        // Ruta de la carpeta asociada al estándar
        $folderPath = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $nombreEstandar . '/' . $soporte->detfuente;

        // Verificar si la carpeta existe antes de intentar eliminarla
        if (File::exists($folderPath)) {
            // Eliminar la carpeta asociada al estándar
            File::deleteDirectory($folderPath);
        }
        $soporte->delete();
        
        return redirect()->route('admin.fuentes.index')->with('flash', 'eliminado');
    }
}
