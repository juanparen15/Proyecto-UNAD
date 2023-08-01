<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function index()
    {
        $empresa = Empresa::first();
        return view('admin.empresa.index', compact('empresa'));
    }
    public function edit(Empresa $empresa)
    {
        return view('admin.empresa.edit', compact('empresa'));
    }
    public function update(Request $request, Empresa $empresa)
    {
        $empresa->update($request->all());
        return redirect()->route('empresa.index');
    }
}
