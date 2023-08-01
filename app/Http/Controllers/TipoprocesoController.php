<?php

namespace App\Http\Controllers;

use App\Tipoproceso;
use Illuminate\Http\Request;
use App\Http\Requests\Tipoproceso\StoreRequest;
use App\Http\Requests\Tipoproceso\UpdateRequest;
use Illuminate\Support\Str;

class TipoprocesoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware([
            'permission:admin.tipoprocesos.store',
            'permission:admin.tipoprocesos.index',
            'permission:admin.tipoprocesos.create',
            'permission:admin.tipoprocesos.update',
            'permission:admin.tipoprocesos.destroy',
            'permission:admin.tipoprocesos.edit'
            ]);
    }
    public function index()
    {
        $tipoprocesos = Tipoproceso::get();
       return view ('admin.tipoprocesos.index',compact('tipoprocesos'));
    }

    
    public function create()
    {
        return view ('admin.tipoprocesos.create');
    }

    
    public function store(StoreRequest $request)
    {
        Tipoproceso::create([
            'dettipoproceso'=>$request->dettipoproceso,
            'slug'=> Str::slug($request->dettipoproceso , '-'),
        ]);
        return redirect()->route('admin.tipoprocesos.index')->with('flash','registrado');
    }

    // 
    // 
    // 
    public function show(Tipoproceso $tipoproceso)
    {
        return view ('admin.tipoprocesos.show',compact('tipodeproceso'));
    }

    
    public function edit(Tipoproceso $tipoproceso)
    {
        return view ('admin.tipoprocesos.edit',compact('tipoproceso'));
    }

    
    public function update(UpdateRequest $request, Tipoproceso $tipoproceso)
    {
        $tipoproceso->update([
            'dettipoproceso'=>$request->dettipoproceso,
            'slug'=> Str::slug($request->dettipoproceso , '-'),
        ]);
        return redirect()->route('admin.tipoprocesos.index')->with('flash','actualizado');
    }

   
    public function destroy(Tipoproceso $tipoproceso)
    {
        $tipoproceso->delete();
        return redirect()->route('admin.tipoprocesos.index')->with('flash','eliminado');
    }
}