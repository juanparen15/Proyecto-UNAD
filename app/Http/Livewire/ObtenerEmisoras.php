<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Ciudad;
use App\Estandar;
use App\Fuente;
use App\Emisora;

class ObtenerEmisoras extends Component
{
    public $selectedCiudad = null, $selectedEstandar = null, $selectedTipoemisora = null, $selectedEmisora = null;
    public $estandares = null, $tipoemisoras = null, $emisoras = null;

    public function render()
    {
        return view('planadquisiciones.create', [
            'ciudades' => Ciudad::all(),
            // 'estandares' => $this->estandares,
            // 'fuentes' => $this->tipoemisoras,
            // 'emisoras' => $this->emisoras,
        ]);
    }

    public function updatedselectedCiudad($ciudad_id)
    {
        $this->estandares = Estandar::where('ciudad_id', $ciudad_id)->get();
        return response()->json($this);
    }

    public function updatedselectedEstandar($estandar_id)
    {
        $this->tipoemisoras = Fuente::where('estandar_id', $estandar_id)->get();
        return response()->json($this);
    }

    public function updatedselectedTipoemisora($tipoemisora_id)
    {
        $this->emisoras = Emisora::where('tipoemisora_id', $tipoemisora_id)->get();
        return response()->json($this);
    }
}
