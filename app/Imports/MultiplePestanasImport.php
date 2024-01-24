<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultiplePestanasImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            0 => new PotenciaImport(),
            1 => new BucaramangaImport(),
            2 => new MedellinImport(),
            3 => new CaliImport(),
            // Agrega más hojas según sea necesario
        ];
    }
}
