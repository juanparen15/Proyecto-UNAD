<?php

namespace App\Http\Controllers;

use App\Imports\MultiplePestanasImport;
use App\Imports\PotenciaImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcelController extends Controller
{
    public function potencia_import(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new MultiplePestanasImport, $file);
        return back()->with('message', 'Importación de datos completada.');
    }
}
