<?php

namespace App\Imports;

use App\Segmento;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;


class SegmentoImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Segmento([
            'id'=>$row[0],
            'detsegmento'=>$row[1],
            'slug'=> Str::slug($row[1]),
        ]);
    }
}
