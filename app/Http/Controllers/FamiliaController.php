<?php

namespace App\Http\Controllers;

use App\Familia;
use App\Ciudad;
use Illuminate\Http\Request;
use App\Http\Requests\familia\StoreRequest;
use App\Http\Requests\familia\UpdateRequest;
use Illuminate\Support\Str;
class FamiliaController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware([
            'permission:admin.familias.index',
            'permission:admin.familias.store',
            'permission:admin.familias.create',
            'permission:admin.familias.update',
            'permission:admin.familias.destroy',
            'permission:admin.familias.edit' 
            ]);
    }
    public function index()
    {
        $familias = Familia::get();
        return view ('admin.familias.index',compact('familias'));
    }
    
    public function create()
    {
        $ciudades =  Ciudad::get();
        return view ('admin.familias.create',compact('ciudades'));
    }
    
    public function store(StoreRequest $request)
    {
        Familia::create([
            'detfamilia'=> $request->detfamilia,
            'slug'=> Str::slug($request->detfamilia , '-'),
            'ciudad_id'=> $request->ciudad_id
        ]);
        return redirect()->route('admin.familias.index')->with('flash','registrado');
    }

    
    public function show(Familia $familia)
    {
        return view ('admin.familias.show',compact('familia'));
    }
   
    public function edit(Familia $subserie)
    {
        $ciudades = Ciudad::get();
        return view ('admin.familias.edit',compact('subserie','ciudades'));
    }

    
    public function update(UpdateRequest $request, Familia $subserie)
    {
        $subserie->update([
            'detfamilia'=> $request->detfamilia,
            'slug'=> Str::slug($request->detfamilia , '-'),
            'ciudad_id'=> $request->ciudad_id
        ]);
        return redirect()->route('admin.familias.index')->with('flash','actualizado');
    }

   
    public function destroy(Familia $subserie)
    {
        $subserie->delete();
        return redirect()->route('admin.familias.index')->with('flash','eliminado');
    }
}
