<?php

namespace App\Exports;

use App\Planadquisicione;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

// class PlanadquisicioneExport implements FromCollection
class PlanadquisicioneExport implements FromView
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        $plan = Planadquisicione::find($this->id);
        return view('admin.planadquisiciones.plantilla_de_excel', [
            'plan' => $plan
        ]);
    }
}
