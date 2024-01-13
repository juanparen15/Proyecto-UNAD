<?php

namespace App\Http\Controllers;

use App\Estandar;
use App\Ciudad;
use Illuminate\Http\Request;
use App\Http\Requests\estandar\StoreRequest;
use App\Http\Requests\estandar\UpdateRequest;
use Illuminate\Support\Str;

class EstandarController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware([
            'permission:admin.estandares.index',
            'permission:admin.estandares.store',
            'permission:admin.estandares.create',
            'permission:admin.estandares.update',
            'permission:admin.estandares.destroy',
            'permission:admin.estandares.edit'
        ]);
    }
    public function index()
    {
        $estandares = Estandar::get();
        return view('admin.estandares.index', compact('estandares'));
    }

    public function create()
    {
        $ciudades =  Ciudad::get();
        return view('admin.estandares.create', compact('ciudades'));
    }

    public function store(StoreRequest $request)
    {
        Estandar::create([
            'detestandar' => $request->detestandar,
            'slug' => Str::slug($request->detestandar, '-'),
            'ciudad_id' => $request->ciudad_id
        ]);
        return redirect()->route('admin.estandares.index')->with('flash', 'registrado');
    }


    public function show(Estandar $estandar)
    {
        return view('admin.estandares.show', compact('estandar'));
    }

    public function edit(Estandar $estandar)
    {
        $ciudades = Ciudad::get();
        // $estandar->load('ciudad');
        return view('admin.estandares.edit', compact('estandar', 'ciudades'));
    }


    public function update(UpdateRequest $request, Estandar $estandar)
    {
        $estandar->update([
            'detestandar' => $request->detestandar,
            'slug' => Str::slug($request->detestandar, '-'),
            'ciudad_id' => $request->ciudad_id,
        ]);
        return redirect()->route('admin.estandares.index')->with('flash', 'actualizado');
    }

    public function destroy(Estandar $estandar)
    {
        $estandar->delete();
        return redirect()->route('admin.estandares.index')->with('flash', 'eliminado');
    }
}
