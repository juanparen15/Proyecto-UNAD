<?php

namespace App\Http\Controllers;

use App\Tipozona;
use Illuminate\Http\Request;
use App\Http\Requests\Tipozona\StoreRequest;
use App\Http\Requests\Tipozona\UpdateRequest;
use Illuminate\Support\Str;
class TipozonaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware([
            'permission:tipozonas.index'
            ]);
    }
    public function index()
    {
        $tipozonas = Tipozona::get();
       return view ('admin.tipozonas.index',compact('tipozonas'));
    }
    
    public function create()
    {
        return view ('admin.tipozonas.create');
    }
    
    public function store(StoreRequest $request)
    {
        Tipozona::create([
            'tipozona'=>$request->tipozona,
            'slug'=> Str::slug($request->tipozona , '-'),
        ]);
        return redirect()->route('tipozonas.index')->with('info','El Tipo de Zona se Creo con Exito');
    }
    
    public function show(Tipozona $tipozona)
    {
        return view ('admin.tipozonas.show',compact('tipozona'));
    }
    
    public function edit(Tipozona $tipozona)
    {
        return view ('admin.tipozonas.show',compact('tipozona'));
    }

    
    public function update(UpdateRequest $request, Tipozona $tipozona)
    {
        $tipozona->update([
            'tipozona'=>$request->tipozona,
            'slug'=> Str::slug($request->tipozona , '-'),
        ]);
        return redirect()->route('tipozonas.index')->with('info','El Tipo Zona se Actualizo con Exito');
    }

    
    public function destroy(Tipozona $tipozona)
    {
        $tipozona->delete();
        return redirect()->route('tipozonas.index')->with('info','El Tipo Zona se Elimino con Exito');
    }
}
