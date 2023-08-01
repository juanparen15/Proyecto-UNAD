<?php

namespace App\Http\Controllers;

use App\Area;
use App\Dependencia;
use Illuminate\Http\Request;
use App\Http\Requests\Area\StoreRequest;
use App\Http\Requests\Area\UpdateRequest;
use Illuminate\Support\Str;

class AreaController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware([
            'permission:admin.areas.index',
            'permission:admin.areas.store',
            'permission:admin.areas.create',
            'permission:admin.areas.update',
            'permission:admin.areas.destroy',
            'permission:admin.areas.edit'
            ]);
    }
    
    public function index()
    {
        $areas = Area::get();
       return view ('admin.areas.index',compact('areas'));
    }
    
    public function create()
    {      
        $dependencias = Dependencia::get();
        return view ('admin.areas.create',compact('dependencias'));
    }
    
    public function store(StoreRequest $request)
    {
        Area::create([
            'nomarea'=>$request->nomarea,
            'slug'=> Str::slug($request->nomarea , '-'),
            'dependencia_id'=>$request->dependencia_id,
        ]);

        return redirect()->route('admin.areas.index')->with('flash','registrado');
    }
    
    // public function show(Area $area)
    // {
    //     return view ('admin.areas.show',compact('area'));
    // }
    
    public function edit(Area $area)
    {
        $dependencias = Dependencia::get();
        return view ('admin.areas.edit',compact('area','dependencias'));
    }

    public function update(UpdateRequest $request, Area $area)
    {
        $area->update([
            'nomarea'=>$request->nomarea,
            'slug'=> Str::slug($request->nomarea , '-'),
            'dependencia_id'=>$request->dependencia_id,
        ]);
        return redirect()->route('admin.areas.index')->with('flash','actualizado');
    }
    
    public function destroy(Area $area)
    {
        $area->delete();
        return redirect()->route('admin.areas.index')->with('flash','eliminado');
    }
}
