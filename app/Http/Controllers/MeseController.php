<?php

namespace App\Http\Controllers;

use App\Mese;
use Illuminate\Http\Request;
use App\Http\Requests\Mese\StoreRequest;
use App\Http\Requests\Mese\UpdateRequest;
class MeseController extends Controller
{    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware([
            'permission:admin.meses.index'
            ]);
    }
    public function index()
    {
        $meses = Mese::get();
        return view ('admin.meses.index',compact('meses'));
    }

    
    public function create()
    {
        return view ('admin.meses.create');
    }

    
    public function store(StoreRequest $request)
    {
        Mese::create($request->all());
        return redirect()->route('meses.index')->with('info','El mes se Creo con Exito');
    }
   
    public function show(Mese $mese)
    {
        return view ('admin.meses.show',compact('mese'));
    }

    
    public function edit(Mese $mese)
    {
        return view ('admin.meses.show',compact('mese'));
    }

    
    public function update(UpdateRequest $request, Mese $mese)
    {
        $mese->update($request->all());
        return redirect()->route('meses.index')->with('info','El mes se Actualizo con Exito');
    }

   
    public function destroy(Mese $mese)
    {
        $mese->delete();
        return redirect()->route('admin.meses.index')->with('info','El mes se Elimino con Exito');
    }
}
