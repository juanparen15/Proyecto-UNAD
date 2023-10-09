<?php

namespace App\Http\Controllers;

use App\Area;
use App\Clase;
use App\Dependencia;
use App\Familia;
use App\Planadquisicione;
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
        $products = Producto::all()->count();
        $clases = Clase::all()->count();
        $segmentos = Segmento::all()->count();
        $familias = Familia::all()->count();
        $dependencias = Dependencia::all()->count();
        $areas = Area::all()->count();
        $adquisiciones = Planadquisicione::all()->count();
        $adquisiciones1 = Planadquisicione::all()->count();
        $adquisiciones3 = Planadquisicione::all()->count();
        $adquisiciones2 = Planadquisicione::with('area')->get();




        // return view("home", ["data" => json_encode($carpetas)]);

        $carpetas = [];


        if (auth()->user()->hasRole('Admin')) {
            $planes = Planadquisicione::select(
                DB::raw("count(*) as count"),
                DB::raw("count(*) as totalmes"),
                DB::raw("DATE_FORMAT(created_at,'%M %Y') as mes")
            )->groupBy('mes')->take(12)->get();


            $adquisiciones3 = Planadquisicione::select(
                DB::raw("count(*) as count"),
                DB::raw("count(carpeta) as adq"),
                DB::raw("DATE_FORMAT(fechaInicial, '%Y') as anyo")
            )
                ->orderBy('anyo', 'DESC')
                ->groupBy('anyo')->take(12)->get();


            // Accede a los datos de la relación
            foreach ($adquisiciones3 as $adq) {
                // $area = $adq->area; // "area" es el nombre del método de relación en el modelo Planadquisicione
                // $nombreArea = $area->nomarea; // Accede a los campos de la relación (ejemplo: "nomarea")
                $fechaInicial = $adq->fechaInicial;
                // Puedes usar $nombreArea en tu lógica aquí
            }

            $carpetas = [];

            foreach ($adquisiciones2 as $adq) {
                // $nombreArea = $adq->area->nomarea;
                $fechaInicial = $adq->fechaInicial;
                $carpetas[] = ['name' => $adq->carpeta, 'description' => $adq->$fechaInicial];
            }



            $adquisiciones = Planadquisicione::select(
                'area_id',
                DB::raw('count(*) as adq'),
                DB::raw('MAX(areas.nomarea) as area_name'),
                // ->groupby(DB::raw("carpeta"))
                // ->pluck('count')
                // DB::raw("DATE_FORMAT(fechaInicial,'%M %Y') as anyo"),
                DB::raw("count(carpeta) as adq")
            )
                ->join('areas', 'planadquisiciones.area_id', '=', 'areas.id') // Realiza una join con la tabla de áreas
                // DB::raw("count(area_id) as area_adq"))
                // DB::raw("DATE_FORMAT(fechaInicial,'%M %Y') as anyo"))
                ->groupBy(DB::raw("area_id"))
                ->get();
            // Accede a los datos de la relación
            foreach ($adquisiciones as $adq) {
                $area = $adq->area; // "area" es el nombre del método de relación en el modelo Planadquisicione
                $nombreArea = $area->nomarea; // Accede a los campos de la relación (ejemplo: "nomarea")
                // Puedes usar $nombreArea en tu lógica aquí
            }

            $carpetas = [];

            foreach ($adquisiciones2 as $adq) {
                $nombreArea = $adq->area->nomarea;
                $carpetas[] = ['name' => $adq->carpeta, 'y' => floatval($nombreArea)];
            }
        } else {
            $planes = Planadquisicione::where('user_id', auth()->user()->id)->select(
                DB::raw("count(*) as count"),
                DB::raw("count(*) as totalmes"),
                DB::raw("DATE_FORMAT(created_at,'%M %Y') as mes")
            )->groupBy('mes')->take(12)->get();

            $adquisiciones3 = Planadquisicione::where('user_id', auth()->user()->id)->select(
                DB::raw("count(*) as count"),
                DB::raw("count(carpeta) as adq"),
                DB::raw("DATE_FORMAT(fechaInicial,'%Y') as anyo")
            )
                ->orderBy('anyo', 'DESC')
                ->join('areas', 'planadquisiciones.area_id', '=', 'areas.id')
                ->groupBy('anyo')->take(12)->get();

            // Accede a los datos de la relación
            foreach ($adquisiciones3 as $adq) {
                // $area = $adq->area; // "area" es el nombre del método de relación en el modelo Planadquisicione
                // $nombreArea = $area->nomarea; // Accede a los campos de la relación (ejemplo: "nomarea")
                $fechaInicial = $adq->fechaInicial;
                // Puedes usar $nombreArea en tu lógica aquí
            }

            $carpetas = [];

            foreach ($adquisiciones2 as $adq) {
                // $nombreArea = $adq->area->nomarea;
                $fechaInicial = $adq->fechaInicial;
                $carpetas[] = ['name' => $adq->carpeta, 'description' => $adq->$fechaInicial];
            }



            $adquisiciones = Planadquisicione::where('user_id', auth()->user()->id)->select(
                'area_id',
                DB::raw('count(*) as adq'),
                DB::raw('MAX(areas.nomarea) as area_name'),
                // ->groupby(DB::raw("carpeta"))
                // ->pluck('count')
                // DB::raw("DATE_FORMAT(fechaInicial,'%M %Y') as anyo"),
                DB::raw("count(carpeta) as adq")
            )
                ->join('areas', 'planadquisiciones.area_id', '=', 'areas.id') // Realiza una join con la tabla de áreas
                // DB::raw("count(area_id) as area_adq"))
                // DB::raw("DATE_FORMAT(fechaInicial,'%M %Y') as anyo"))
                ->groupBy(DB::raw("area_id"))
                ->get();
            // Accede a los datos de la relación
            foreach ($adquisiciones as $adq) {
                $area = $adq->area; // "area" es el nombre del método de relación en el modelo Planadquisicione
                $nombreArea = $area->nomarea; // Accede a los campos de la relación (ejemplo: "nomarea")
                // Puedes usar $nombreArea en tu lógica aquí
            }

            $carpetas = [];

            foreach ($adquisiciones2 as $adq) {
                $nombreArea = $adq->area->nomarea;
                $carpetas[] = ['name' => $adq->carpeta, 'y' => floatval($nombreArea)];
            }
        }




        return view("home", ["data" => json_encode($carpetas)], compact('users', 'products', 'clases', 'segmentos', 'familias', 'adquisiciones', 'adquisiciones1',  'adquisiciones3', 'dependencias', 'areas', 'planes'));
    }
}
<<<<<<< HEAD

=======
>>>>>>> 1a999b14985d2f51353890f6c69076dc6dc103d8
