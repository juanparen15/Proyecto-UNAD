<?php

namespace App\Imports;

use App\Planadquisicione;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;

class PlanadquisicioneImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Planadquisicione([
            // 'id'=> $row[0],
            'caja'=> $row[0],
            'carpeta'=> $row[1],
            'tomo'=> $row[2],
            'folio'=> $row[3],
            'nota'=> $row[4],
            'modalidad_id'=> $row[5],
            'fuente_id'=> $row[6],
            'tipoprioridade_id'=> $row[7],
            'user_id'=> $row[8],
            'slug'=> Str::slug($row[4]),
            'requiproyecto_id'=> $row[9],
            'requipoais_id'=> $row[10],
            'otro'=> $row[11],
            'segmento_id'=> $row[12],
            'familias_id'=> $row[13],
            'fechaInicial'=> $row[14],
            'fechaFinal'=> $row[15],
            'area_id'=> $row[16]
        ]);
    }
}
