<?php

namespace App\Http\Controllers;

use App\Clase;
use App\Producto;
use Illuminate\Http\Request;
use App\Http\Requests\Producto\StoreRequest;
use App\Http\Requests\Producto\UpdateRequest;
use Illuminate\Support\Str;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware([
            'permission:admin.productos.store',
            'permission:admin.productos.index',
            'permission:admin.productos.create', 
            'permission:admin.productos.update',
            'permission:admin.productos.destroy',
            'permission:admin.productos.edit'
            ]); 
    }
    public function index()
    {
        
        return view ('admin.productos.index');
    }

    public function create()
    {
        $clases = Clase::get();
        return view ('admin.productos.create',compact('clases'));
    }
    
    public function store(StoreRequest $request)
    {
        Producto::create([
            'detproducto'=>$request->detproducto,
            'slug'=> Str::slug($request->detproducto , '-'),
            'clase_id'=>$request->clase_id
        ]);
        return redirect()->route('admin.productos.index')->with('flash','registrado');
    }
//     actualizado
// 
// 
    public function show(Producto $producto)
    {
        return view ('admin.productos.show',compact('producto'));
    }
    
    public function edit(Producto $producto)
    {
        $clases = Clase::get();
        return view ('admin.productos.edit',compact('producto','clases'));
    }
    
    public function update(UpdateRequest $request, Producto $producto)
    {
        $producto->update([
            'detproducto'=>$request->detproducto,
            'slug'=> Str::slug($request->detproducto , '-'),
            'clase_id'=>$request->clase_id
        ]);
        return redirect()->route('admin.productos.index')->with('flash','actualizado');
    }
    
    public function destroy($slug)
    {
        $producto = Producto::where('slug', $slug)->first();
        $producto->delete();
        return redirect()->route('admin.productos.index')->with('flash','eliminado');
    }
}
