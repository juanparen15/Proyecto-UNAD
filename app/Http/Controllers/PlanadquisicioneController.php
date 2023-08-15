<?php

namespace App\Http\Controllers;

use App\Planadquisicione;
use App\Requipoai;
use App\Area;
use App\Familia;
use App\Requiproyecto;
use App\Fuente;
use App\User;
use App\Mese;
use App\Modalidade;
use App\Estadovigencia;
use App\Exports\PlanadquisicioneAllExport;
use App\Exports\PlanadquisicioneExport;
use App\Producto;
use App\Segmento;
use App\Tipoadquisicione;
use App\Tipoprioridade;
use App\Tipozona;
use App\Tipoproceso;
use App\Vigenfutura;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class PlanadquisicioneController extends Controller
{
    public function __construct()
    {

        $this->middleware([
            'auth',
            'permission:planadquisiciones.index'
        ]);
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

        // $user = auth()->user();
        // if ($user->hasRole('Admin')) {
        //     $planadquisiciones = Planadquisicione::get();
        // } else {
        //     $planadquisiciones = Planadquisicione::where('area_id', $user->area_id)->get();
        // }


        // if (session('showOnlyAdmin')) {
        //     $adminId = auth()->user()->id;
        //     $planadquisiciones = Planadquisicione::where('user_id', $adminId)->get();
        //     // $planadquisiciones = Planadquisicione::where('user_id', auth()->user()->id)->get();
        //     session()->forget('showOnlyAdmin');
        // } else {
        //     $planadquisiciones = Planadquisicione::get();
        //     $planadquisiciones = Planadquisicione::where('user_id', auth()->user()->id)->get();
        // }


        if (auth()->user()->hasRole('Admin')) {
            $planadquisiciones = Planadquisicione::get();
            // $planadquisiciones = Planadquisicione::where('user_id', auth()->user()->id)->get();
        } else {
            $planadquisiciones = Planadquisicione::where('user_id', auth()->user()->id)->get();
            // $planadquisiciones = Planadquisicione::get();
        }
        return view('admin.planadquisiciones.index', compact('planadquisiciones'));
    }

    public function indexByArea($areaId)
    {
        $areas = Area::findOrFail($areaId);
        $planadquisiciones = Planadquisicione::where('area_id', $areaId)->get();

        return view('admin.planadquisiciones.index', compact('planadquisiciones', 'areas'));
    }




    public function create()
    {
        $userArea = auth()->user()->area; // Obtener el área asociada al usuario
        $segmentos = Segmento::get();
        $familias = Familia::get();
        $modalidades = Modalidade::get();
        $areas = collect([$userArea]); // Crear una colección con el área del usuario
        $fuentes = Fuente::get();
        // $requiproyectos = Requiproyecto::get();
        $tipoprioridades = Tipoprioridade::get();
        $requipoais = Requipoai::get();
        $requiproyectos = Requiproyecto::where('areas_id', auth()->user()->area->id)->pluck('detproyeto', 'id');

        return view('admin.planadquisiciones.create', compact('requipoais', 'modalidades', 'familias', 'segmentos', 'areas', 'fuentes', 'requiproyectos', 'tipoprioridades'));
    }



    public function store(Request $request)
    {

        $request->validate([
            'caja' => ['required'],
            'carpeta' => ['required'],
            'tomo' => ['required'],
            // 'otro' => ['required'],
            'folio' => ['required'],
            'nota' => ['required'],
            'modalidad_id' => ['required'],
            'segmento_id' => ['required'],
            'familias_id' => ['required'],
            'fuente_id' => ['required'],
            'tipoprioridade_id' => ['required'],
            'requiproyecto_id' => ['required'],
            'fechaInicial' => ['required'],
            'fechaFinal' => ['required'],
            'requipoais_id' => ['required'],
            'area_id' => ['required']
        ]);


        $slug = Str::slug($request->nota, '-');

        // Verificar si ya existe un Planadquisicione con el mismo slug
        $counter = 1;
        while (Planadquisicione::where('slug', $slug)->exists()) {
            $slug = Str::slug($request->nota, '-') . '-' . $counter;
            $counter++;
        }

        $planadquisicione = Planadquisicione::create(array_merge($request->all(), [
            'user_id' => auth()->user()->id,
            'slug' => $slug
        ]));

        // Realmente no necesitas volver a verificar si el slug es único aquí,
        // ya que ya lo has asegurado antes de crear el registro.

        // ... (código para manejar la relación muchos a muchos si es necesario)

        return redirect()->route('planadquisiciones.index')->with('flash', 'registrado');
    }


    public function show(Planadquisicione $inventario)
    {
        return view('admin.planadquisiciones.show', compact('inventario'));
    }


    public function edit(Planadquisicione $inventario)
    {
        $userArea = $inventario->user->area; // Obtener el área asociada al usuario
        $segmentos = Segmento::get();
        $familias = Familia::get();
        $modalidades = Modalidade::get();
        $fuentes = Fuente::get();
        // $requiproyectos = Requiproyecto::get();
        $tipoprioridades = Tipoprioridade::get();
        $requipoais = Requipoai::get();
        $requiproyectos = Requiproyecto::where('areas_id', auth()->user()->area->id)->pluck('detproyeto', 'id');
        return view('admin.planadquisiciones.edit', compact('requipoais', 'modalidades', 'familias', 'segmentos', 'fuentes', 'requiproyectos', 'tipoprioridades', 'inventario', 'userArea'));
    }




    public function update(Request $request, Planadquisicione $inventario)
    {

        $request->validate([
            'caja' => ['required'],
            'carpeta' => ['required'],
            'tomo' => ['required'],
            // 'otro' => ['required'],
            'folio' => ['required'],
            'nota' => ['required'],
            'requipoais_id' => ['required'],
            'modalidad_id' => ['required'],
            'segmento_id' => ['required'],
            'familias_id' => ['required'],
            'fuente_id' => ['required'],
            'tipoprioridade_id' => ['required'],
            'requiproyecto_id' => ['required'],
            'fechaInicial' => ['required'],
            'fechaFinal' => ['required'],
            'area_id' => ['required']
        ]);

        $slug = Str::slug($request->nota, '-');

        // Verificar si el nuevo slug ya existe para otro registro
        $counter = 1;
        while (Planadquisicione::where('slug', $slug)->where('id', '<>', $inventario->id)->exists()) {
            $slug = Str::slug($request->nota, '-') . '-' . $counter;
            $counter++;
        }

        $inventario->update(array_merge($request->all(), [
            'user_id' => auth()->user()->id,
            'slug' => $slug
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

        return Excel::download(new PlanadquisicioneExport($planadquisicion->id), 'Inventario Documental - ' . $planadquisicion->id . '.xlsx');
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



        return Excel::download(new PlanadquisicioneAllExport, 'Inventario Documental en General.xlsx');
    }
}
