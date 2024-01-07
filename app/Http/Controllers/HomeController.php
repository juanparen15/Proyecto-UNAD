<?php

namespace App\Http\Controllers;

use App\Area;
use App\Clase;
use App\Dependencia;
use App\Familia;
use App\Planadquisicione;
use App\Potencia;
use App\Producto;
use App\Segmento;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
        $users = User::all()->count();
        // $products = Producto::all()->count();
        // $clases = Clase::all()->count();
        // $segmentos = Segmento::all()->count();
        // $familias = Familia::all()->count();
        // $dependencias = Dependencia::all()->count();
        // $areas = Area::all()->count();
        // $adquisiciones = Planadquisicione::all()->count();
        // $adquisiciones1 = Planadquisicione::all()->count();
        // $adquisiciones3 = Planadquisicione::all()->count();
        // $adquisiciones2 = Planadquisicione::with('area')->get();
        $potencia = Potencia::all();
        // $potencias = Potencia::pluck('potencia')->toArray();
        // $potencias = Potencia::pluck('potencia')->map(function ($potencia) {
        //     return floatval($potencia);
        // })->toArray();

        // return view("home", ["data" => json_encode($carpetas)]);



        // if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Supervisor')) {
        //     $planes = Planadquisicione::select(
        //         DB::raw("count(*) as count"),
        //         DB::raw("count(*) as totalmes"),
        //         DB::raw("DATE_FORMAT(created_at,'%M %Y') as mes")
        //     )->groupBy('mes')->take(12)->get();


        // $potencias = Potencia::select(
        //     'potencia',
        //     DB::raw("count(potencia) as pot")
        // )->groupBy('potencia')->get();
        $potencias = Potencia::select(
            'potencia',
            DB::raw("SUM(potencia) as pot"),
        )->groupBy('potencia')->get();

        $potenciasData = [];
        foreach ($potencias as $potencia) {
            $potenciasData[] = ['name' => $potencia->potencia, 'y' => $potencia->pot];
        }

        $potencias2 = Potencia::select(
            'segundaPotencia',
            DB::raw("SUM(segundaPotencia) as pot2"),
        )->groupBy('segundaPotencia')->get();

        $potenciasData2 = [];
        foreach ($potencias2 as $segundaPotencia) {
            $potenciasData2[] = ['name' => $segundaPotencia->segundaPotencia, 'y' => $segundaPotencia->pot2];
        }
        $potencias3 = Potencia::select(
            'terceraPotencia',
            DB::raw("SUM(terceraPotencia) as pot3"),
        )->groupBy('terceraPotencia')->get();

        $potenciasData3 = [];
        foreach ($potencias3 as $terceraPotencia) {
            $potenciasData3[] = ['name' => $terceraPotencia->terceraPotencia, 'y' => $terceraPotencia->pot3];
        }
        $potencias4 = Potencia::select(
            'cuartaPotencia',
            DB::raw("SUM(cuartaPotencia) as pot4"),
        )->groupBy('cuartaPotencia')->get();

        $potenciasData4 = [];
        foreach ($potencias4 as $cuartaPotencia) {
            $potenciasData4[] = ['name' => $cuartaPotencia->cuartaPotencia, 'y' => $cuartaPotencia->pot4];
        }
        //     // Accede a los datos de la relación
        //     foreach ($adquisiciones3 as $adq) {
        //         // $area = $adq->area; // "area" es el nombre del método de relación en el modelo Planadquisicione
        //         // $nombreArea = $area->nomarea; // Accede a los campos de la relación (ejemplo: "nomarea")
        //         $fechaInicial = $adq->fechaInicial;
        //         // Puedes usar $nombreArea en tu lógica aquí
        //     }

        //     $carpetas = [];

        //     foreach ($adquisiciones2 as $adq) {
        //         // $nombreArea = $adq->area->nomarea;
        //         $fechaInicial = $adq->fechaInicial;
        //         $carpetas[] = ['name' => $adq->carpeta, 'description' => $adq->$fechaInicial];
        //     }



        //     $adquisiciones = Planadquisicione::select(
        //         'area_id',
        //         DB::raw('count(*) as adq'),
        //         DB::raw('MAX(areas.nomarea) as area_name'),
        //         // ->groupby(DB::raw("carpeta"))
        //         // ->pluck('count')
        //         // DB::raw("DATE_FORMAT(fechaInicial,'%M %Y') as anyo"),
        //         DB::raw("count(carpeta) as adq")
        //     )
        //         ->join('areas', 'planadquisiciones.area_id', '=', 'areas.id') // Realiza una join con la tabla de áreas
        //         // DB::raw("count(area_id) as area_adq"))
        //         // DB::raw("DATE_FORMAT(fechaInicial,'%M %Y') as anyo"))
        //         ->groupBy(DB::raw("area_id"))
        //         ->get();
        //     // Accede a los datos de la relación
        //     foreach ($adquisiciones as $adq) {
        //         $area = $adq->area; // "area" es el nombre del método de relación en el modelo Planadquisicione
        //         $nombreArea = $area->nomarea; // Accede a los campos de la relación (ejemplo: "nomarea")
        //         // Puedes usar $nombreArea en tu lógica aquí
        //     }

        //     $carpetas = [];

        //     foreach ($adquisiciones2 as $adq) {
        //         $nombreArea = $adq->area->nomarea;
        //         $carpetas[] = ['name' => $adq->carpeta, 'y' => floatval($nombreArea)];
        //     }
        // } else {
        //     $planes = Planadquisicione::where('user_id', auth()->user()->id)->select(
        //         DB::raw("count(*) as count"),
        //         DB::raw("count(*) as totalmes"),
        //         DB::raw("DATE_FORMAT(created_at,'%M %Y') as mes")
        //     )->groupBy('mes')->take(12)->get();

        //     $adquisiciones3 = Planadquisicione::where('user_id', auth()->user()->id)->select(
        //         DB::raw("count(*) as count"),
        //         DB::raw("count(carpeta) as adq"),
        //         DB::raw("DATE_FORMAT(fechaInicial,'%Y') as anyo")
        //     )
        //         ->orderBy('anyo', 'DESC')
        //         ->join('areas', 'planadquisiciones.area_id', '=', 'areas.id')
        //         ->groupBy('anyo')->take(12)->get();

        //     // Accede a los datos de la relación
        //     foreach ($adquisiciones3 as $adq) {
        //         // $area = $adq->area; // "area" es el nombre del método de relación en el modelo Planadquisicione
        //         // $nombreArea = $area->nomarea; // Accede a los campos de la relación (ejemplo: "nomarea")
        //         $fechaInicial = $adq->fechaInicial;
        //         // Puedes usar $nombreArea en tu lógica aquí
        //     }

        //     $carpetas = [];

        //     foreach ($adquisiciones2 as $adq) {
        //         // $nombreArea = $adq->area->nomarea;
        //         $fechaInicial = $adq->fechaInicial;
        //         $carpetas[] = ['name' => $adq->carpeta, 'description' => $adq->$fechaInicial];
        //     }



        //     $adquisiciones = Planadquisicione::where('user_id', auth()->user()->id)->select(
        //         'area_id',
        //         DB::raw('count(*) as adq'),
        //         DB::raw('MAX(areas.nomarea) as area_name'),
        //         // ->groupby(DB::raw("carpeta"))
        //         // ->pluck('count')
        //         // DB::raw("DATE_FORMAT(fechaInicial,'%M %Y') as anyo"),
        //         DB::raw("count(carpeta) as adq")
        //     )
        //         ->join('areas', 'planadquisiciones.area_id', '=', 'areas.id') // Realiza una join con la tabla de áreas
        //         // DB::raw("count(area_id) as area_adq"))
        //         // DB::raw("DATE_FORMAT(fechaInicial,'%M %Y') as anyo"))
        //         ->groupBy(DB::raw("area_id"))
        //         ->get();
        //     // Accede a los datos de la relación
        //     foreach ($adquisiciones as $adq) {
        //         $area = $adq->area; // "area" es el nombre del método de relación en el modelo Planadquisicione
        //         $nombreArea = $area->nomarea; // Accede a los campos de la relación (ejemplo: "nomarea")
        //         // Puedes usar $nombreArea en tu lógica aquí
        //     }

        //     $carpetas = [];

        //     foreach ($adquisiciones2 as $adq) {
        //         $nombreArea = $adq->area->nomarea;
        //         $carpetas[] = ['name' => $adq->carpeta, 'y' => floatval($nombreArea)];
        //     }
        // }




        // return view("home", ["data" => $potencias], compact('users', 'potencias'));
        // return view("home", ["data" => $potencias], compact('users', 'potencias'));

        // return view("home", ["data" => $potencias->toArray()], compact('users', 'potencias'));
        return view("home", ["data" => $potenciasData, $potenciasData2, $potenciasData3, $potenciasData4], compact('users', 'potencias', 'potencias2','potencias3', 'potencias4'));


        // return view("home", ["potencias" => json_encode($potencias)]);
    }
}
