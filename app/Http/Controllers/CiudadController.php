<?php

namespace App\Http\Controllers;

use App\Ciudad;
use Illuminate\Http\Request;
use App\Http\Requests\Ciudad\StoreRequest;
use App\Http\Requests\Ciudad\UpdateRequest;
use Illuminate\Support\Str;

class CiudadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware([
            'permission:admin.ciudades.store',
            'permission:admin.ciudades.index',
            'permission:admin.ciudades.create',
            'permission:admin.ciudades.update',
            'permission:admin.ciudades.destroy',
            'permission:admin.ciudades.edit'
        ]);
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
        Ciudad::create([
            // 'id'=> $request->id,
            'detciudad' => $request->detciudad,
            'slug' => Str::slug($request->detciudad, '-')
        ]);
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
        $ciudade->update([
            'detciudad' => $request->detciudad,
            'slug' => Str::slug($request->detciudad, '-')
        ]);
    
        return redirect()->route('admin.ciudades.index')->with('flash', 'actualizado');
    }


    public function destroy(Ciudad $ciudad)
    {
        $ciudad->delete();
        return redirect()->route('admin.ciudades.index')->with('flash', 'eliminado');
    }
}
