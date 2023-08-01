<?php

namespace App\Http\Controllers;
use App\Http\Requests\Clase\StoreRequest;
use App\Http\Requests\Clase\UpdateRequest;
use App\Clase;
use App\Familia;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ClaseController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware([
            'permission:admin.clases.store', 
            'permission:admin.clases.index',
            'permission:admin.clases.create', 
            'permission:admin.clases.update',
            'permission:admin.clases.destroy',
            'permission:admin.clases.edit'
            ]);
    }
    public function index()
    {
        $clases = Clase::orderBy('id', 'DESC')->paginate(10);
       return view ('admin.clases.index',compact('clases'));
    }

    
    public function create()
    {
        $familias = Familia::all();
        return view ('admin.clases.create',compact('familias'));
    }

    
    public function store(StoreRequest $request)
    {
        Clase::create([
            'detclase'=>$request->detclase,
            'slug'=> Str::slug($request->detclase , '-'),
            'familia_id'=>$request->familia_id,
        ]);
        return redirect()->route('admin.clases.index')->with('flash','registrado');
    }

    // public function show(Clase $clase)
    // {
    //     return view ('admin.clases.show',compact('clase'));
    // }

    
    public function edit(Clase $clase)
    {
        $familias = Familia::get();
        return view ('admin.clases.edit',compact('clase','familias'));
    }

    
    public function update(UpdateRequest $request, Clase $clase)
    {
        $clase->update([
            'detclase'=>$request->detclase,
            'slug'=> Str::slug($request->detclase , '-'),
            'familia_id'=>$request->familia_id,
        ]);
        return redirect()->route('admin.clases.index')->with('flash','actualizado');
    }
    
    public function destroy(Clase $clase)
    {
        $clase->delete();
        return redirect()->route('admin.clases.index')->with('flash','eliminado');
    }
}
