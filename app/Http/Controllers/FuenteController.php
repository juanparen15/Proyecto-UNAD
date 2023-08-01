<?php

namespace App\Http\Controllers;

use App\Fuente;
use Illuminate\Http\Request;
use App\Http\Requests\Fuente\StoreRequest;
use App\Http\Requests\Fuente\UpdateRequest;
use Illuminate\Support\Str;
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
       return view ('admin.fuentes.index',compact('fuentes'));
    }

    
    public function create()
    {
        return view ('admin.fuentes.create');
    }
    
    public function store(StoreRequest $request)
    {
        Fuente::create([
            'detfuente'=>$request->detfuente,
            'slug'=> Str::slug($request->detfuente , '-'),
        ]);
        return redirect()->route('admin.fuentes.index')->with('flash','registrado');
    }

    
    public function show(Fuente $fuente)
    {
        return view ('admin.fuentes.show',compact('fuente'));
    }

    
    public function edit(Fuente $soporte)
    {
        return view ('admin.fuentes.edit',compact('soporte'));
    }

    
    public function update(UpdateRequest $request, Fuente $soporte)
    {
        $soporte->update([
            'detfuente'=>$request->detfuente,
            'slug'=> Str::slug($request->detfuente , '-'),
        ]);
        return redirect()->route('admin.fuentes.index')->with('flash','actualizado');
    }
   
    public function destroy(Fuente $soporte)
    {
        $soporte->delete();
        return redirect()->route('admin.fuentes.index')->with('flash','eliminado');
    }
}
