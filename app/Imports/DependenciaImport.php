<?php

namespace App\Imports;

use App\Dependencia;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;

class DependenciaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Dependencia([
            'id'=> $row[0],
            'nomdependencia'=> $row[1],
            'slug'=> Str::slug($row[1]),
        ]);
    }
}
