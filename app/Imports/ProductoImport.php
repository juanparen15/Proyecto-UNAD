<?php

namespace App\Imports;

use App\Producto;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
class ProductoImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Producto([
            'clase_id'=>$row[0],
            'id'=>$row[1],
            'detproducto'=>$row[2],
            'slug'=> Str::slug($row[2]),
        ]);
    }
}
