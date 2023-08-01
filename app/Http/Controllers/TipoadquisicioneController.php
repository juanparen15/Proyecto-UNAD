<?php

namespace App\Http\Controllers;

use App\Tipoadquisicione;
use Illuminate\Http\Request;
use App\Http\Requests\Tipoadquisicione\StoreRequest;
use App\Http\Requests\Tipoadquisicione\UpdateRequest;
class TipoadquisicioneController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware([
            'permission:tipoadquicsiciones',
            ]);
    }
    public function index()
    {
        $tipoadquisiciones = Tipoadquisicione::get();
        return view ('admin.tipoadquisiciones.index',compact('tipoadquisicines'));
    }

    public function create()
    {
        return view ('admin.tipoadquisiciones.create');
    }

    
    public function store(StoreRequest $request)
    {
        tipoadquisicione::create($request->all());
        return redirect()->route('tipoadquisiciones.index')->with('info','El Tipo Adquisicion se Creo con Exito');
    }

    
    public function show(Tipoadquisicione $tipoadquisicione)
    {
        return view ('admin.tipoadquisiciones.show',compact('tipoadquisicione'));
    }

    
    public function edit(Tipoadquisicione $tipoadquisicione)
    {
        return view ('admin.tipoadquisiciones.show',compact('tipoadquisicione'));
    }

    public function update(UpdateRequest $request, Tipoadquisicione $tipoadquisicione)
    {
        $tipoadquisicione->update($request->all());
        return redirect()->route('tipoadquisiciones.index')->with('info','El Tipo Adquisicion se Actualizo con Exito');
    }
    
    public function destroy(Tipoadquisicione $tipoadquisicione)
    {
        $tipoadquisicione->delete();
        return redirect()->route('admin.tipoadquisiciones.index')->with('info','El Tipo Adquisione se Elimino con Exito');
    }
}
