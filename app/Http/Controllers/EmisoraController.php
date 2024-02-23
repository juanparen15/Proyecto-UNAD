<?php

namespace App\Http\Controllers;

use App\Ciudad;
use App\Emisora;
use App\Estandar;
use App\Fuente;
use Illuminate\Http\Request;
use App\Http\Requests\Emisora\StoreRequest;
use App\Http\Requests\Emisora\UpdateRequest;
use App\TipoSimulacion;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class EmisoraController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin');
        // $this->middleware([
        //     'permission:admin.emisoras.store',
        //     'permission:admin.emisoras.index',
        //     'permission:admin.emisoras.create',
        //     'permission:admin.emisoras.destroy',
        //     'permission:admin.emisoras.update',
        //     'permission:admin.emisoras.edit'
        // ]);
    }
    public function index()
    {
        $emisoras = Emisora::get();
        return view('admin.emisoras.index', compact('emisoras'));
    }


    public function create(Emisora $emisora)
    {
        $ciudades = Ciudad::get();
        $estandares = Estandar::get();
        $tipos = TipoSimulacion::get();

        return view('admin.emisoras.create', compact('estandares', 'ciudades', 'tipos', 'emisora'));
    }

    public function store(StoreRequest $request)
    {

        $slug = Str::slug($request->emisora);

        // Verificar si ya existe un Inventario con el mismo slug
        $counter = 1;
        while (Emisora::where('slug', $slug)->exists()) {
            $slug = Str::slug($request->emisora . '-' . $counter, '-');
            $counter++;
        }
        // Obtén el último ID en la tabla y agrega 1 para generar un número de orden único
        $ultimoId = Emisora::max('id') + 1;

        $slugWithId = $slug . '-' . $ultimoId;


        $emisora = Emisora::create([
            'emisora' => $request->emisora,
            'slug' => $slugWithId,
            'tipoemisora_id' => $request->tipoemisora_id
        ]);


        // Obtener el nombre de la ciudad utilizando el ID
        $nombreCiudad = Ciudad::findOrFail($request->ciudad_id)->detciudad;
        $nombreEstandar = Estandar::findOrFail($request->estandar_id)->detestandar;
        $nombreTipoEmisora = Fuente::findOrFail($request->tipoemisora_id)->detfuente;

        // Crear la carpeta para el estándar de la ciudad utilizando el nombre ingresado
        $carpetaEmisora = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $nombreEstandar . '/' . $nombreTipoEmisora . '/' . $request->emisora;

        // Verificar si la carpeta no existe y luego crearla
        if (!File::exists($carpetaEmisora)) {
            File::makeDirectory($carpetaEmisora, 0777, true);
        }

        // Rutas de origen y destino para los directorios que deseas copiar
        $rutaCss = public_path('/adminlte/ExtensionesMapas/css');
        $rutaJs = public_path('/adminlte/ExtensionesMapas/js');
        $rutaWebFonts = public_path('/adminlte/ExtensionesMapas/webfonts');
        $rutaDestino = $carpetaEmisora . '/'; // La carpeta de destino que ya has creado

        // Copiar los directorios y su contenido
        File::copyDirectory($rutaCss, $rutaDestino);
        File::copyDirectory($rutaJs, $rutaDestino);
        File::copyDirectory($rutaWebFonts, $rutaDestino);

        return redirect()->route('admin.emisoras.index')->with('flash', 'registrado');
    }


    public function show(Emisora $emisora)
    {
        $ciudades = Ciudad::get();
        $estandares = Estandar::get();
        $fuentes = Fuente::get();

        return view('admin.emisoras.show', compact('estandares', 'ciudades', 'fuentes', 'emisora'));
    }


    public function edit(Emisora $emisoras)
    {
        return view('admin.emisoras.edit', compact('emisoras'));
    }


    public function update(UpdateRequest $request, Emisora $emisoras)
    {
        $slug = Str::slug($request->emisora);

        // Verificar si el nuevo slug ya existe para otro registro
        $counter = 1;
        while (Emisora::where('slug', $slug)->where('id', '<>', $emisoras->id)->exists()) {
            $slug = $slug . '-' . $counter;
            $counter++;
        }

        // Obtén el último ID en la tabla y agrega 1 para generar un número de orden único
        $ultimoId = Emisora::max('id');

        $slugWithId = $slug . '-' . $ultimoId;

        // Guardar el nombre anterior del estándar
        $oldEmisoraName = $emisoras->emisora;


        $emisoras->update([
            'emisora' => $request->emisora,
            'slug' => $slugWithId,
            'tipoemisora_id' => $request->tipoemisora_id
        ]);

        // Verificar si el nombre del estándar ha cambiado
        if ($oldEmisoraName !== $request->emisora) {
            // Obtener el nombre de la ciudad utilizando el ID
            $nombreCiudad = Ciudad::findOrFail($request->ciudad_id)->detciudad;
            $nombreEstandar = Estandar::findOrFail($request->estandar_id)->detestandar;
            $nombreTipoEmisora = Fuente::findOrFail($request->tipoemisora_id)->detfuente;

            // Renombrar la carpeta del estándar
            $oldFolderPath = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $nombreEstandar . '/' . $nombreTipoEmisora . '/' . $oldEmisoraName;
            $newFolderPath = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $nombreEstandar . '/' . $nombreTipoEmisora . '/' . $request->emisora;

            if (File::exists($oldFolderPath)) {
                File::move($oldFolderPath, $newFolderPath);
            }
        }
        return redirect()->route('admin.emisoras.index')->with('flash', 'actualizado');
    }

    public function destroy(Emisora $emisoras)
    {

        // Obtener el nombre de la ciudad utilizando el ID del estándar
        $nombreCiudad = $emisoras->fuente->estandar->ciudad->detciudad;
        $nombreEstandar = $emisoras->fuente->estandar->detestandar;
        $nombreTipoEmisora = $emisoras->fuente->detfuente;

        // Ruta de la carpeta asociada al estándar
        $folderPath = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $nombreEstandar . '/' . $nombreTipoEmisora . '/' . $emisoras->emisora;

        // Verificar si la carpeta existe antes de intentar eliminarla
        if (File::exists($folderPath)) {
            // Eliminar la carpeta asociada al estándar
            File::deleteDirectory($folderPath);
        }
        $emisoras->delete();

        return redirect()->route('admin.emisoras.index')->with('flash', 'eliminado');
    }
}
