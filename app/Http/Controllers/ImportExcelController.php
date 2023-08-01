<?php

namespace App\Http\Controllers;

use App\Imports\AreasImport;
use App\Imports\ClaseImport;
use App\Imports\DependenciaImport;
use App\Imports\EstadovigenciaImport;
use App\Imports\FamiliaImport;
use App\Imports\FuenteImport;
use App\Imports\ModalidadeImport;
use App\Imports\ProductoImport;
use App\Imports\SegmentoImport;
use App\Imports\PlanadquisicioneImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcelController extends Controller
{
    public function areas_import(Request $request){
        $file = $request->file('file');
        Excel::import(new AreasImport, $file);
        return back()->with('message', 'Importación de áreas completada.');
    }
    public function dependencias_import(Request $request){
        $file = $request->file('file');
        Excel::import(new DependenciaImport, $file);
        return back()->with('message', 'Importación de dependencias completada.');
    }
    public function planadquisicione_import(Request $request){
        $file = $request->file('file');
        Excel::import(new PlanadquisicioneImport, $file);
        return back()->with('message', 'Importación de Inventario completada.');
    }
    public function estado_vigencia_import(Request $request){
        $file = $request->file('file');
        Excel::import(new EstadovigenciaImport, $file);
        return back()->with('message', 'Importación de estado de vigencia completada.');
    }

    public function familias_import(Request $request){
        $file = $request->file('file');
        Excel::import(new FamiliaImport, $file);
        return back()->with('message', 'Importación de familias completada.');
    }
    public function segmento_import(Request $request){
        $file = $request->file('file');
        Excel::import(new SegmentoImport, $file);
        return back()->with('message', 'Importación de segmentos completada.');
    }
    public function clases_import(Request $request){
        $file = $request->file('file');
        Excel::import(new ClaseImport, $file);
        return back()->with('message', 'Importación de clases completada.');
    }
    public function fuentes_import(Request $request){
        $file = $request->file('file');
        Excel::import(new FuenteImport, $file);
        return back()->with('message', 'Importación de fuentes completada.');
    }
    public function modalidades_import(Request $request){
        $file = $request->file('file');
        Excel::import(new ModalidadeImport, $file);
        return back()->with('message', 'Importación de modalidades completada.');
    }
    public function productos_import(Request $request){
        $file = $request->file('file');
        Excel::import(new ProductoImport, $file);
        return back()->with('message', 'Importación de productos completada.');
    }
}
