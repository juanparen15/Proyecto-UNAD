<?php

namespace App\Http\Controllers;

use App\Area;
use App\Clase;
use App\Familia;
use App\Fuente;
use App\Producto;
use App\Tipoproceso;
use App\Planadquisicione;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function obtener_familias(Request $request)
    {
        if ($request->ajax()) {
            try {
                $familias = Familia::where('segmento_id', $request->segmento_id)->get();
                return response()->json($familias);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }
    public function obtener_tipoEmisoras(Request $request)
    {

        if ($request->ajax()) {
            try {
                $tipoEmisora = Fuente::where('familias_id', $request->estandar_id)->get();
                return response()->json($tipoEmisora);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }
    public function obtener_emisoras(Request $request)
    {

        if ($request->ajax()) {
            try {
                $emisora = Fuente::where('fuente_id', $request->emisora_id)->get();
                return response()->json($emisora);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }
    public function obtener_codigo(Request $request)
    {
        if ($request->ajax()) {
            $area = Area::where('area_id', $request->area_id)->get();
            return response()->json($area);
        }
    }
    // public function obtener_clases(Request $request){
    //     if ($request->ajax()) {
    //         $clases = Clase::where('familia_id', $request->familia_id)->get();
    //         return response()->json($clases);
    //     }
    // }
    // public function obtener_productos(Request $request){
    //     if ($request->ajax()) {
    //         $productos = Producto::where('clase_id', $request->clase_id)->get();
    //         return response()->json($productos);
    //     }
    // }
}
