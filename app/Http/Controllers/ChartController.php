<?php

namespace App\Http\Controllers;

use App\Area;
use App\Clase;
use App\Dependencia;
use App\Familia;
use App\Planadquisicione;
use App\Producto;
use App\Segmento;
// use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $users = User::all()->count();
        // $products = Producto::all()->count();
        // $clases = Clase::all()->count();
        // $segmentos = Segmento::all()->count();
        // $familias = Familia::all()->count();
        // $dependencias = Dependencia::all()->count();
        // $areas = Area::all()->count();
        // $adquisiciones = Planadquisicione::all()->count();
        // $adquisiciones1 = Planadquisicione::all()->count();
        $adquisiciones2 = Planadquisicione::all();


        // $adquisiciones1 = Planadquisicione::select(
        //     DB::raw("count(*) as count"),
        //     // ->groupby(DB::raw("carpeta"))
        //     // ->pluck('count')
        //     DB::raw("count(carpeta) as adq"))
        //     // DB::raw("count(area_id) as area_adq"))
        //     // DB::raw("DATE_FORMAT(fechaInicial,'%M %Y') as anyo"))
        // ->groupBy(DB::raw("area_id"))
        // ->get();

        $carpetas = [];
        foreach ($adquisiciones2 as $adq) {
            $carpetas[] = ['name' => $adq['nombre'], 'y' => floatval($adq['porcentaje'])];
        }
        return view('home', ["data" => json_encode($carpetas)]);
    }
}
