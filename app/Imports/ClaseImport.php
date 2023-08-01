<?php

namespace App\Imports;

use App\Clase;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;

class ClaseImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Clase([
            'familia_id'=>$row[0],
            'id'=>$row[1],
            'detclase'=>$row[2],
            'slug'=> Str::slug($row[2])
        ]);
    }
}
