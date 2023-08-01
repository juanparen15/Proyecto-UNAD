<?php

namespace App\Http\Controllers;

use App\Modalidade;
use Illuminate\Http\Request;
use App\Http\Requests\Modalidade\StoreRequest;
use App\Http\Requests\Modalidade\UpdateRequest;
use Illuminate\Support\Str;

class ModalidadeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware([
            'permission:admin.modalidades.store',
            'permission:admin.modalidades.index',
            'permission:admin.modalidades.create',
            'permission:admin.modalidades.update',
            'permission:admin.modalidades.destroy',
            'permission:admin.modalidades.edit'
            ]);
    }
    public function index()
    {
        $modalidades = Modalidade::get();
        return view ('admin.modalidades.index',compact('modalidades'));
    }

    
    public function create()
    {
        return view ('admin.modalidades.create');
    }

    
    public function store(StoreRequest $request)
    {
        Modalidade::create([
            'detmodalidad'=>$request->detmodalidad,
            'slug'=> Str::slug($request->detmodalidad , '-'),
        ]);
        return redirect()->route('admin.modalidades.index')->with('flash','registrado');
    }
        
    public function show(Modalidade $modalidade)
    {
        return view ('admin.modalidades.show',compact('modalidade'));
    }

    
    public function edit(Modalidade $objeto)
    {
        return view ('admin.modalidades.edit',compact('objeto'));
    }

    
    public function update(UpdateRequest $request, Modalidade $objeto)
    {
        $objeto->update([
            'detmodalidad'=>$request->detmodalidad,
            'slug'=> Str::slug($request->detmodalidad , '-'),
        ]);
        return redirect()->route('admin.modalidades.index')->with('flash','actualizado');
    }

    
    public function destroy(Modalidade $objeto)
    {
        $objeto->delete();
        return redirect()->route('admin.modalidades.index')->with('flash','eliminado');
    }
}
