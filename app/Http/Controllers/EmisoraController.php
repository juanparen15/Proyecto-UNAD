<?php

namespace App\Http\Controllers;

use App\Ciudad;
use App\Emisora;
use App\Estandar;
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
    }
    public function index()
    {
        // $emisoras = Emisora::get();
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
        $nombreTipoEmisora = TipoSimulacion::findOrFail($request->tipoemisora_id)->detfuente;

        // Crear la carpeta para el estándar de la ciudad utilizando el nombre ingresado
        $carpetaEmisora = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $nombreEstandar . '/' . $nombreTipoEmisora . '/' . $request->emisora;
        $css = 'css';
        $js = 'js';
        $web = 'webfonts';
        $kmz = 'kmz';
        // Verificar si la carpeta no existe y luego crearla
        if (!File::exists($carpetaEmisora)) {
            File::makeDirectory($carpetaEmisora, 0777, true);
            File::makeDirectory($carpetaEmisora . '/' . $css, 0777, true);
            File::makeDirectory($carpetaEmisora . '/' . $js, 0777, true);
            File::makeDirectory($carpetaEmisora . '/' . $web, 0777, true);
            File::makeDirectory($carpetaEmisora . '/' . $kmz, 0777, true);
        }

        // Rutas de origen y destino para los directorios que deseas copiar
        $rutaCss = public_path('/adminlte/ExtensionesMapas/css');
        $rutaJs = public_path('/adminlte/ExtensionesMapas/js');
        $rutaWebFonts = public_path('/adminlte/ExtensionesMapas/webfonts');
        $rutaDestinoCss = $carpetaEmisora . '/' . $css; // La carpeta de destino que ya has creado
        $rutaDestinoJs = $carpetaEmisora . '/' . $js; // La carpeta de destino que ya has creado
        $rutaDestinoWeb = $carpetaEmisora . '/' . $web; // La carpeta de destino que ya has creado

        // Copiar los directorios y su contenido
        File::copyDirectory($rutaCss, $rutaDestinoCss);
        File::copyDirectory($rutaJs, $rutaDestinoJs);
        File::copyDirectory($rutaWebFonts, $rutaDestinoWeb);

        return redirect()->route('admin.emisoras.index')->with('flash', 'registrado');
    }


    public function show(Emisora $emisora)
    {
        $ciudades = Ciudad::get();
        $estandares = Estandar::get();
        $tipos = TipoSimulacion::get();

        return view('admin.emisoras.show', compact('estandares', 'ciudades', 'tipos', 'emisora'));
    }


    public function edit(Emisora $emisoras)
    {
        $ciudades = Ciudad::get();
        $estandares = Estandar::get();
        $tipos = TipoSimulacion::get();
        return view('admin.emisoras.edit', compact('ciudades', 'estandares', 'tipos', 'emisoras'));
    }


    public function update(UpdateRequest $request, Emisora $emisoras)
    {
        // // $emisoras = $emisoras->where('slug', $slug)->firstOrFail();
        // $ciudades = Ciudad::get();
        // $estandares = Estandar::get();
        // // $tipos = TipoSimulacion::get();
        // $tipos = TipoSimulacion::where('ciudad_id', $emisoras->tipo->estandar->ciudad_id)->get();
        // // $estandares = Estandar::where('ciudad_id', $emisoras->tipo->estandar->ciudad_id)->get();

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
            $nombreTipoEmisora = TipoSimulacion::findOrFail($request->tipoemisora_id)->detfuente;

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

        $ciudades = Ciudad::get();
        $estandares = Estandar::get();
        $tipos = TipoSimulacion::get();

        // Obtener el nombre de la ciudad utilizando el ID del estándar
        // foreach ($emisoras as $emisora) {
        $nombreCiudad = $emisoras->tipo->estandar->ciudad->detciudad;
        $nombreEstandar = $emisoras->tipo->estandar->detestandar;
        $nombreTipoEmisora = $emisoras->tipo->detfuente;
        // }
        // Ruta de la carpeta asociada al estándar
        $folderPath = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $nombreEstandar . '/' . $nombreTipoEmisora . '/' . $emisoras->emisora;

        // Verificar si la carpeta existe antes de intentar eliminarla
        if (File::exists($folderPath)) {
            // Eliminar la carpeta asociada al estándar
            File::deleteDirectory($folderPath);
        }
        $emisoras->delete();

        return redirect()->route('admin.emisoras.index', compact('ciudades', 'estandares', 'tipos'))->with('flash', 'eliminado');
    }
}
