<?php

namespace App\Http\Controllers;

use App\Tipozona;
use App\Vigenfutura;
use Illuminate\Http\Request;
use App\Http\Requests\Vigenfutura\StoreRequest;
use App\Http\Requests\Vigenfutura\UpdateRequest;
class VigenfuturaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $vigenfuturas = Vigenfutura::get();
        return view ('admin.vigenfuturas.index',compact('vigenfuturas'));
    }

    
    public function create()
    {
        return view ('admin.vigenfuturas.create');
    }

    
    public function store(StoreRequest $request)
    {
        Vigenfutura::create($request->all());
        return redirect()->route('vigenfuturas.index')->with('info','La Vigencia Futura se Creo con Exito');
    }
    
    public function show(Vigenfutura $vigenfutura)
    {
        return view ('admin.vigenfuturas.show',compact('vigenfutura'));
    }

   
    public function edit(Vigenfutura $vigenfutura)
    {
        return view ('admin.vigenfuturas.show',compact('vigenfutura'));
    }

    
    public function update(UpdateRequest $request, Vigenfutura $vigenfutura)
    {
        $vigenfutura->update($request->all());
        return redirect()->route('vigenfuturas.index')->with('info','La Vigencia Futura se Actualizo con Exito');
    }

   
    public function destroy(Vigenfutura $vigenfutura)
    {
        $vigenfutura->delete();
        return redirect()->route('admin.vigenfuturas.index')->with('info','La Vigencia Futura se Elimino con Exito');
    }
}
