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
        
        if (auth()->user()->hasRole('Admin')) {
            $planes = Planadquisicione::select(
                DB::raw("count(*) as count"),
                DB::raw("count(*) as totalmes"),
                DB::raw("DATE_FORMAT(created_at,'%M %Y') as mes")
            )->groupBy('mes')->take(12)->get();
        } else {
            $planes = Planadquisicione::where('user_id', auth()->user()->id)->select(
                DB::raw("count(*) as count"),
                DB::raw("count(*) as totalmes"),
                DB::raw("DATE_FORMAT(created_at,'%M %Y') as mes")
            )->groupBy('mes')->take(12)->get();
        }

        return view('home', compact('users', 'products', 'clases','segmentos','familias' ,'adquisiciones','dependencias','areas', 'planes'));
    }
}
