<?php

namespace App\Http\Controllers;

use App\Planadquisicione;
use App\Area;
use App\Estandar;
use App\Fuente;
use App\Exports\PlanadquisicioneAllExport;
use App\Exports\PlanadquisicioneExport;
use App\Ciudad;
use App\Emisora;
use App\Http\Requests\Planadquisicione\StoreRequest;
use App\Http\Requests\Planadquisicione\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PlanadquisicioneController extends Controller
{
    public function __construct()
    {

        $this->middleware([
            'auth',
            // $this->middleware('role:supervisor', ['only' => ['index']]),
            // 'permission:planadquisiciones.index',
            // 'permission:supervisor.planadquisiciones.index',
        ]);
        // $this->middleware('role:Admin');
        $this->middleware('role:User', ['except' => ['show']]);
    }

    public function showOnlyAdmin()
    {
        $adminId = auth()->user()->id;
        $planadquisiciones = Planadquisicione::where('user_id', $adminId)->get();
        session()->put('showOnlyAdmin', true);

        return view('admin.planadquisiciones.index', compact('planadquisiciones'));
    }

    public function index()
    {

        if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Supervisor')) {
            $planadquisiciones = Planadquisicione::get();
        } else {
            $planadquisiciones = Planadquisicione::get();
        }
        return view('admin.planadquisiciones.index', compact('planadquisiciones'));
    }

    public function indexByArea($areaId)
    {
        $areas = Area::findOrFail($areaId);
        $planadquisiciones = Planadquisicione::where('area_id', $areaId)->get();

        return view('admin.planadquisiciones.index', compact('planadquisiciones', 'areas'));
    }




    public function create(Planadquisicione $inventario)
    {

        // $userArea = auth()->user()->area; // Obtener el área asociada al usuario
        // $user = auth()->user()->id;

        $ciudades = Ciudad::get();
        $estandares = Estandar::get();
        // $areas = collect([$userArea]); // Crear una colección con el área del usuario
        $fuentes = Fuente::get();
        $emisoras = Emisora::get();
        // $requiproyectos = Requiproyecto::where('areas_id', auth()->user()->area->id)->pluck('detproyeto', 'id');

        return view('admin.planadquisiciones.create', compact('estandares', 'ciudades', 'fuentes', 'emisoras', 'inventario'));
    }



    public function store(StoreRequest $request)
    {

        $request->validate([
            'tipoemisora_id' => ['required'],
            // 'emisora_id' => ['required'],
            // 'area_id' => ['required']
        ]);

        $slug = Str::slug($request->kmz);

        // Verificar si ya existe un Inventario con el mismo slug
        $counter = 1;
        while (Planadquisicione::where('slug', $slug)->exists()) {
            $slug = Str::slug($request->kmz . '-' . $counter, '-');
            $counter++;
        }

        // Obtén el último ID en la tabla y agrega 1 para generar un número de orden único
        $ultimoId = Planadquisicione::max('id') + 1;

        $slugWithId = $slug . '-' . $ultimoId;

        $planadquisicione = Planadquisicione::create(array_merge($request->all(), [
            'user_id' => auth()->user()->id,
            'kmz' => $request->kmz,
            'coordenada' => $request->coordenada,
            'slug' => $slugWithId,  // Utiliza el slug con el ID agregado
        ]));

        // Obtener el nombre de la ciudad utilizando el ID
        $nombreCiudad = Ciudad::findOrFail($request->ciudad_id)->detciudad;
        $nombreEstandar = Estandar::findOrFail($request->estandar_id)->detestandar;
        $nombreTipoEmisora = Fuente::findOrFail($request->tipoemisora_id)->detfuente;
        $nombreEmisora = Emisora::findOrFail($request->emisora_id)->emisora;
        $nombreCarpetaKmz = File::makeDirectory('kmz', 0777, true);

        // Crear la carpeta para el estándar de la ciudad utilizando el nombre ingresado
        if (!File::exists($nombreEmisora)) {
            $carpetaKmz = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $nombreEstandar . '/' . $nombreTipoEmisora . '/' . $nombreEmisora . '/' . $nombreCarpetaKmz . '/' . $request->kmz;
        } else {
            $carpetaKmz = public_path() . '/adminlte/simulaciones/' . $nombreCiudad . '/' . $nombreEstandar . '/' . $nombreTipoEmisora . '/' . $nombreCarpetaKmz . '/' . $request->kmz;
        }

        // Verificar si la carpeta no existe y luego crearla
        if (!File::exists($carpetaKmz)) {
            File::makeDirectory($carpetaKmz, 0777, true);
        }

        return redirect()->route('planadquisiciones.index')->with('flash', 'registrado');
    }


    // public function show(Planadquisicione $inventario)
    // {
    //     return view('admin.planadquisiciones.show', compact('inventario'));
    // }

    public function show(Planadquisicione $inventario)
    {
        $ciudades = Ciudad::get();
        $estandares = Estandar::get();
        $fuentes = Fuente::get();
        $emisoras = Emisora::get();
        // $planadquisicione = Planadquisicione::with('user', 'fuentes', 'ciudades', 'estandares', 'emisoras')
        //     ->find($inventario);

        return view('admin.planadquisiciones.show', compact('estandares', 'ciudades', 'fuentes', 'emisoras', 'inventario'));
    }

    public function edit(Planadquisicione $inventario)
    {
        // $userArea = $inventario->user->area; // Obtener el área asociada al usuario
        $ciudades = Ciudad::get();
        $estandares = Estandar::get();
        $fuentes = Fuente::get();
        $emisoras = Emisora::get();
        return view('admin.planadquisiciones.edit', compact('estandares', 'ciudades', 'fuentes', 'emisoras', 'inventario'));
    }

    // public function update(Request $request, Planadquisicione $inventario)
    public function update(Request $request, Planadquisicione $planadquisicione)

    {

        $request->validate([
            'kmz' => ['requerid'],
            'tipoemisora_id' => ['required'],
            'emisora_id' => ['required'],
        ]);

        // Obtener los nombres de ciudad, estándar, tipo de emisora y emisora
        $ciudad = $planadquisicione->ciudad->detciudad;
        $estandar = $planadquisicione->fuente->estandar->detestandar;
        $tipoEmisora = $planadquisicione->fuente->detfuente;
        $emisora = $planadquisicione->emisora->emisora ?? 'No Aplica';

        // Construir la ruta donde se guardará el archivo KMZ
        if ($emisora == "No Aplica") {
            $filePath = "adminlte/simulaciones/{$ciudad}/{$estandar}/{$tipoEmisora}/kmz/";
        } else {
            $filePath = "adminlte/simulaciones/{$ciudad}/{$estandar}/{$tipoEmisora}/{$emisora}/kmz/";
        }


        $input = $request->all();
        if ($request->hasFile('kmz')) {
            $file = $request->file('kmz');
            $extension = $file->getClientOriginalExtension();
            $nombreKmz = time() . $file->getClientOriginalName() . $extension;
            $file->move(public_path() . $filePath, $nombreKmz);
            $input['kmz'] = $nombreKmz;
        }

        $slug = Str::slug($request->kmz);

        // Verificar si el nuevo slug ya existe para otro registro
        $counter = 1;
        while (Planadquisicione::where('slug', $slug)->where('id', '<>', $planadquisicione->id)->exists()) {
            $slug = $slug . '-' . $counter;
            $counter++;
        }

        // Obtén el último ID en la tabla y agrega 1 para generar un número de orden único
        $ultimoId = Planadquisicione::max('id');

        $slugWithId = $slug . '-' . $ultimoId;
        $planadquisicione->update(array_merge($request->all(), [
            'user_id' => auth()->user()->id,
            'slug' => $slugWithId  // Utiliza el slug con el ID agregado
        ]));

        // ... (código para manejar la relación muchos a muchos si es necesario)

        return redirect()->route('planadquisiciones.index')->with('flash', 'actualizado');
    }

    public function destroy(Planadquisicione $planadquisicion)
    {
        $planadquisicion->delete();
        return redirect()->route('planadquisiciones.index')->with('flash', 'eliminado');
    }

    // public function retirar_producto(Planadquisicione $planadquisicione,Producto $producto){
    //     $producto_id = $producto->id;

    //     $planadquisicione->productos()->detach($producto_id);
    //     return redirect()->route('planadquisiciones.show', $planadquisicione)->with('flash','actualizado');
    // }

    public function exportar_planadquisiciones_excel(Planadquisicione $planadquisicion)
    {

        return Excel::download(new PlanadquisicioneExport($planadquisicion->id), 'Puntos de Ciudad - ' . $planadquisicion->id . '.xlsx');
        // 
        // plan_de_adquisicion 
    }
    // public function agregar_producto(Planadquisicione $planadquisicion)
    // {
    //     $segmentos = Segmento::all();
    //     return view('admin.planadquisiciones.agregar_producto', compact('planadquisicion', 'segmentos'));
    // }
    // public function agregar_producto_store(Request $request, Planadquisicione $planadquisicion)
    // {
    //     $planadquisicion->productos()->attach($request->producto_id);
    //     return redirect()->route('planadquisiciones.show', $planadquisicion)->with('flash', 'actualizado');
    // }
    public function export()
    {



        return Excel::download(new PlanadquisicioneAllExport, 'Puntos de Ciudad en General.xlsx');
    }

    // public function chart()
    // {
    //     $planadquisiciones = Planadquisicione::select(\DB::raw("COUNT(*) as count"))
    //         ->whereYear('created_at', date('Y'))
    //         ->groupBy(\DB::raw("Second(created_at)"))
    //         ->pluck('count');
    //     return view('planadquisiciones.chart', compact('planadquisiciones'));
    // }
}
