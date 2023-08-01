<?php

namespace App\Http\Controllers;

use App\Estadovigencia;
use Illuminate\Http\Request;
use App\Http\Requests\Estadovigencia\StoreRequest;
use App\Http\Requests\Estadovigencia\UpdateRequest;
use Illuminate\Support\Str;

class EstadovigenciaController extends Controller
{    
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware([
            'permission:admin.estadovigencias.index',
            'permission:admin.estadovigencias.store',
            'permission:admin.estadovigencias.create',
            'permission:admin.estadovigencias.update',
            'permission:admin.estadovigencias.destroy',
            'permission:admin.estadovigencias.edit'
            ]);

    }
    public function index()
    {
        $estadovigencias = Estadovigencia::get();
       return view ('admin.estadovigencias.index',compact('estadovigencias'));
    }

    
    public function create()
    {
        return view ('admin.estadovigencias.create');
    }

    
    public function store(StoreRequest $request)
    {
        Estadovigencia::create([
            'detestadovigencia'=>$request->detestadovigencia,
            'slug'=> Str::slug($request->detestadovigencia , '-'),
        ]);
        return redirect()->route('admin.estadovigencias.index')->with('flash','registrado');
    }

    public function show(Estadovigencia $estadovigencia)
    {
        return view ('admin.estadovigencias.show',compact('estadovigencia'));
    }

    public function edit(Estadovigencia $estadovigencia)
    {
        return view ('admin.estadovigencias.edit',compact('estadovigencia'));
    }

    public function update(UpdateRequest $request, Estadovigencia $estadovigencia)
    {
        $estadovigencia->update([
            'detestadovigencia'=>$request->detestadovigencia,
            'slug'=> Str::slug($request->detestadovigencia , '-'),
        ]);
        return redirect()->route('admin.estadovigencias.index')->with('flash','actualizado');
    }

    public function destroy(Estadovigencia $estadovigencia)
    {
        $estadovigencia->delete();
        return redirect()->route('admin.estadovigencias.index')->with('flash','eliminado');
    }
}
