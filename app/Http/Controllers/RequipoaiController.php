<?php

namespace App\Http\Controllers;

use App\Requipoai;
use Illuminate\Http\Request;
use App\Http\Requests\Requipoai\StoreRequest;
use App\Http\Requests\Requipoai\UpdateRequest;
use App\Tipoadquisicione;

class RequipoaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    public function index()
    {
        $requipoais = Requipoai::get();
        return view ('admin.tipoadquicsiciones.index',compact('requipoais'));
    }
    
    public function create()
    {
        return view ('admin.tipoadquicsiciones.create');
    }

    
    public function store(StoreRequest $request)
    {
        Requipoai::create($request->all());
        return redirect()->route('admin.tipoadquicsiciones.index')->with('info','El POAI se Creo con Exito');
    }

    
    public function show(Requipoai $requipoai)
    {
        return view ('admin.tipoadquicsiciones.show',compact('requipoai'));
    }
   
    public function edit(Requipoai $requipoai)
    {
        return view ('admin.tipoadquicsiciones.show',compact('requipoai'));
    }

    
    public function update(UpdateRequest $request, Requipoai $requipoai)
    {
        $requipoai->update($request->all());
        return redirect()->route('admin.tipoadquicsiciones.index')->with('info','El POAI se Actualizo con Exito');
    }

    
    public function destroy(Requipoai $requipoai)
    {
        $requipoai->delete();
        return redirect()->route('admin.tipoadquicsiciones.index')->with('info','EL POAI se Elimino con Exito');
    }

   public function tipoadquicsiciones55(){
    $requipoais = Tipoadquisicione::get();
    return view ('admin.tipoadquicsiciones.index2',compact('requipoais'));
    }
}
