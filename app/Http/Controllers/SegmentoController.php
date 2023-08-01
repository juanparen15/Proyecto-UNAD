<?php

namespace App\Http\Controllers;

use App\Segmento;
use Illuminate\Http\Request;
use App\Http\Requests\Segmento\StoreRequest;
use App\Http\Requests\Segmento\UpdateRequest;
use Illuminate\Support\Str;
class SegmentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware([
            'permission:admin.segmentos.store',
            'permission:admin.segmentos.index', 
            'permission:admin.segmentos.create',
            'permission:admin.segmentos.update',
            'permission:admin.segmentos.destroy',
            'permission:admin.segmentos.edit'
            ]);
    }
    public function index()
    {
        $segmentos = Segmento::get();
        return view ('admin.segmentos.index',compact('segmentos'));
    }

    
    public function create()
    {
        return view ('admin.segmentos.create');
    }

    
    public function store(StoreRequest $request)
    {
        Segmento::create([
            'detsegmento'=> $request->detsegmento,
            'slug'=> Str::slug($request->detsegmento , '-')
        ]);
        return redirect()->route('admin.segmentos.index')->with('flash','registrado');
    }

    
    public function show(Segmento $segmento)
    {
        return view ('admin.segmentos.show',compact('segmento'));
    }

   
    public function edit(Segmento $serie)
    {
        return view ('admin.segmentos.edit',compact('serie'));
    }

   
    public function update(UpdateRequest $request, Segmento $serie)
    {
        $serie->update([
            'detsegmento'=> $request->detsegmento,
            'slug'=> Str::slug($request->detsegmento , '-')
        ]);
        return redirect()->route('admin.segmentos.index')->with('flash','actualizado');
    }

    
    public function destroy(Segmento $serie)
    {
        $serie->delete();
        return redirect()->route('admin.segmentos.index')->with('flash','eliminado');
    }
}
