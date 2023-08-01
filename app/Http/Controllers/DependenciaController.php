<?php

namespace App\Http\Controllers;

use App\Dependencia;
use Illuminate\Http\Request;
use App\Http\Requests\Dependencia\StoreRequest;
use App\Http\Requests\Dependencia\UpdateRequest;
use Illuminate\Support\Str;
class DependenciaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware([
            'permission:admin.dependencias.index',
            'permission:admin.dependencias.store',
            'permission:admin.dependencias.create',
            'permission:admin.dependencias.destroy',
            'permission:admin.dependencias.update',
            'permission:admin.dependencias.edit'
            ]);
    }
    
    public function index()
    {
       $dependencias = Dependencia::get();
       return view ('admin.dependencias.index',compact('dependencias'));
    }
    
    public function create()
    {
        return view ('admin.dependencias.create');
    }
    
    public function store(StoreRequest $request)
    {
        Dependencia::create([
            'nomdependencia'=>$request->nomdependencia,
            'slug'=> Str::slug($request->nomdependencia , '-'),
        ]);
        return redirect()->route('admin.dependencias.index')->with('flash','registrado');
    }
    
    public function show(Dependencia $dependencia)
    {
        return view ('admin.dependencias.show',compact('dependencia'));
    }
    
    public function edit(Dependencia $dependencia)
    {
        return view ('admin.dependencias.edit',compact('dependencia'));
    }
    
    public function update(UpdateRequest $request, Dependencia $dependencia)
    {
        $dependencia->update([
            'nomdependencia'=>$request->nomdependencia,
            'slug'=> Str::slug($request->nomdependencia , '-'),
        ]);
        return redirect()->route('admin.dependencias.index')->with('flash','actualizado');
    }
    
    public function destroy(Dependencia $dependencia)
    {
        $dependencia->delete();
        return redirect()->route('admin.dependencias.index')->with('flash','eliminado');
    }
}
