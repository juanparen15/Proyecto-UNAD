<?php

namespace App\Http\Controllers;

use App\Tipoprioridade;
use Illuminate\Http\Request;
use App\Http\Requests\Tipoprioridade\StoreRequest;
use App\Http\Requests\Tipoprioridade\UpdateRequest;
use Illuminate\Support\Str;
class TipoprioridadeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware([
            'permission:admin.tipoprioridades.store',
            'permission:admin.tipoprioridades.index', 
            'permission:admin.tipoprioridades.create',
            'permission:admin.tipoprioridades.destroy',
            'permission:admin.tipoprioridades.update',
            'permission:admin.tipoprioridades.edit'
            ]);
    }
    public function index()
    {
        $tipoprioridades = Tipoprioridade::get();
        return view ('admin.tipoprioridades.index',compact('tipoprioridades'));
    }
   
    public function create()
    {
        return view ('admin.tipoprioridades.create');
    }
    // 
    // 
    // 
    public function store(StoreRequest $request)
    {
        Tipoprioridade::create([
            'detprioridad'=>$request->detprioridad,
            'slug'=> Str::slug($request->detprioridad , '-')
        ]);
        return redirect()->route('admin.tipoprioridades.index')->with('flash','registrado');
    }
    
    public function show(Tipoprioridade $tipoprioridade)
    {
        return view ('admin.tipoprioridades.show',compact('tipoprioridade'));
    }

   
    public function edit(Tipoprioridade $tipoprioridade)
    {
        return view ('admin.tipoprioridades.edit',compact('tipoprioridade'));
    }

   
    public function update(UpdateRequest $request, Tipoprioridade $tipoprioridade)
    {
        $tipoprioridade->update([
            'detprioridad'=>$request->detprioridad,
            'slug'=> Str::slug($request->detprioridad , '-')
        ]);
        return redirect()->route('admin.tipoprioridades.index')->with('flash','actualizado');
    }

    
    public function destroy(Tipoprioridade $tipoprioridade)
    {
        $tipoprioridade->delete();
        return redirect()->route('admin.tipoprioridades.index')->with('flash','eliminado');
    }
}
