<?php

namespace App\Http\Controllers;

use App\Requiproyecto;
use App\Area;
use Illuminate\Http\Request;
use App\Http\Requests\Requiproyecto\StoreRequest;
use App\Http\Requests\Requiproyecto\UpdateRequest;
use Illuminate\Support\Str;

class RequiproyectoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware([
            'permission:admin.proyectos.store',
            'permission:admin.proyectos.index',
            'permission:admin.proyectos.create',
            'permission:admin.proyectos.update',
            'permission:admin.proyectos.destroy',
            'permission:admin.proyectos.edit'
        ]);
    }
    public function index()
    {
        $requiproyectos = Requiproyecto::get();
        $areas = Area::get();
        return view('admin.requiproyectos.index', compact('requiproyectos'));
    }


    public function create()
    {
        $areas = Area::get();
        return view('admin.requiproyectos.create', compact('areas'));
    }


    public function store(StoreRequest $request)
    {
        Requiproyecto::create([
            'detproyeto' => $request->detproyeto,
            'areas_id' => $request->areas_id,
            'slug' => Str::slug($request->detproyeto, '-')

        ]);
        return redirect()->route('admin.proyectos.index')->with('flash', 'registrado');
    }

    public function show(Requiproyecto $requiproyecto)
    {
        return view('admin.requiproyectos.show', compact('requiproyecto'));
    }

    // actualizado
    // registrado
    // 
    public function edit(Requiproyecto $codigo)
    {
        $areas = Area::get();
        return view('admin.requiproyectos.edit', compact('areas', 'codigo'));
    }


    public function update(UpdateRequest $request, Requiproyecto $codigo)
    {
        $codigo->update([
            'detproyeto' => $request->detproyeto,
            'areas_id' => $request->areas_id,
            'slug' => Str::slug($request->detproyeto, '-')
        ]);
        return redirect()->route('admin.proyectos.index')->with('flash', 'actualizado');
    }


    public function destroy(Requiproyecto $requiproyecto)
    {
        $requiproyecto->delete();
        return redirect()->route('admin.proyectos.index')->with('flash', 'eliminado');
    }
}
