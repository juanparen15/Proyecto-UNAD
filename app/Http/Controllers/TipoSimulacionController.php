<?php

namespace App\Http\Controllers;

use App\Ciudad;
use App\Estandar;
use App\Http\Requests\TipoSimulacion\StoreRequest;
use App\Http\Requests\TipoSimulacion\UpdateRequest;
use App\TipoSimulacion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class TipoSimulacionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = TipoSimulacion::get();
        return view('admin.tipos.index', compact('tipos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ciudades = Ciudad::get();
        $estandares = Estandar::get();

        return view('admin.tipos.create', compact('estandares', 'ciudades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $slug = Str::slug($request->detfuente);

        // Verificar si ya existe un Inventario con el mismo slug
        $counter = 1;
        while (TipoSimulacion::where('slug', $slug)->exists()) {
            $slug = Str::slug($request->detfuente . '-' . $counter, '-');
            $counter++;
        }
        // Obtén el último ID en la tabla y agrega 1 para generar un número de orden único
        $ultimoId = TipoSimulacion::max('id') + 1;

        $slugWithId = $slug . '-' . $ultimoId;


        $tipoemisora = TipoSimulacion::create([
            'detfuente' => $request->detfuente,
            'slug' => $slugWithId,
            'estandar_id' => $request->estandar_id
        ]);


        // Obtener el nombre de la ciudad utilizando el ID
        $nombreCiudad = Ciudad::findOrFail($request->ciudad_id)->detciudad;
        $nombreEstandar = Estandar::findOrFail($request->estandar_id)->detestandar;

        // Crear la carpeta para el estándar de la ciudad utilizando el nombre ingresado
        $carpetaFuente = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $nombreEstandar . '/' . $request->detfuente;
        $kmz = 'kmz';
        // Verificar si la carpeta no existe y luego crearla
        if (!File::exists($carpetaFuente)) {
            File::makeDirectory($carpetaFuente, 0777, true);
            File::makeDirectory($carpetaFuente . '/' . $kmz, 0777, true);
        }
        return redirect()->route('admin.tipos.index')->with('flash', 'registrado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TipoSimulacion $tipo)
    {
        return view('admin.tipos.show', compact('tipo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoSimulacion $tipo, $slug)
    {
        $tipo = TipoSimulacion::where('slug', $slug)->firstOrFail();
        $ciudades = Ciudad::get();
        // $estandares = Estandar::get();
        $estandares = Estandar::where('ciudad_id', $tipo->estandar->ciudad_id)->get();
        // $tipos = TipoSimulacion::where('slug', $slug)->firstOrFail();
        // $ciudades = Ciudad::where($tipos->estandar->ciudad)->get();
        // $ciudades = Ciudad::all();
        // $estandares = Estandar::where($tipos->estandar_id)->get();
        // $estandares = Estandar::all();
        // $tipos = TipoSimulacion::all();

        // dd($tipo);

        return view('admin.tipos.edit', compact('estandares', 'ciudades',  'tipo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, TipoSimulacion $tipo, $slug)
    {

        // $tipo = TipoSimulacion::where('slug', $slug)->firstOrFail();
        $tipo = $tipo->where('slug', $slug)->firstOrFail();
        $ciudades = Ciudad::get();
        $estandares = Estandar::where('ciudad_id', $tipo->estandar->ciudad_id)->get();
        $oldTipoEmisoraName = $tipo->detfuente;


        $slug = Str::slug($request->detfuente);

        // Verificar si el nuevo slug ya existe para otro registro
        $counter = 1;
        while (TipoSimulacion::where('slug', $slug)->where('id', '<>', $tipo->id)->exists()) {
            $slug = $slug . '-' . $counter;
            $counter++;
        }

        // Obtén el último ID en la tabla y agrega 1 para generar un número de orden único
        $ultimoId = TipoSimulacion::max('id');

        $slugWithId = $slug . '-' . $ultimoId;



        $tipo->update([
            'detfuente' => $request->detfuente,
            'slug' => $slugWithId,
            'estandar_id' => $request->estandar_id,
        ]);

        // dd($oldTipoEmisoraName);

        // Verificar si el nombre del estándar ha cambiado
        if ($oldTipoEmisoraName !== $request->detfuente) {
            // Obtener el nombre de la ciudad utilizando el ID
            $nombreCiudad = Ciudad::findOrFail($request->ciudad_id)->detciudad;
            $nombreEstandar = Estandar::findOrFail($request->estandar_id)->detestandar;

            // Renombrar la carpeta del estándar
            $oldFolderPath = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $nombreEstandar . '/' . $oldTipoEmisoraName;
            $newFolderPath = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $nombreEstandar . '/' . $request->detfuente;

            if (File::exists($oldFolderPath)) {
                // sleep(1); // Espera 5 segundos
                File::move($oldFolderPath, $newFolderPath);
            }
        }
        return redirect()->route('admin.tipos.index', compact('ciudades', 'estandares', 'tipo'))->with('flash', 'actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoSimulacion $tipo)
    {
        // No es necesario buscar $request ya que $tipo ya es la instancia correcta de TipoSimulacion
        $ciudades = Ciudad::get();
        $estandares = Estandar::get();
        $tipos = TipoSimulacion::get();

        // Verificar si la relación estandar es válida y si tiene una ciudad asociada
        foreach ($tipos as $tipo) {
            $nombreCiudad = $tipo->estandar->ciudad->detciudad;
            $nombreEstandar = $tipo->estandar->detestandar;
        }
        // Ruta de la carpeta asociada al estándar
        $folderPath = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $nombreEstandar . '/' . $tipo->detfuente;

        // Verificar si la carpeta existe antes de intentar eliminarla
        if (File::exists($folderPath)) {
            // Eliminar la carpeta asociada al estándar
            File::deleteDirectory($folderPath);
            // Eliminar el registro de TipoSimulacion
        }
        $tipo->delete();


        return redirect()->route('admin.tipos.index', compact('ciudades', 'estandares'))->with('flash', 'El registro fue eliminado correctamente');
    }
}
