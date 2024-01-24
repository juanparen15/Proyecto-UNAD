<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EncabezadoMede extends Model
{
    public $incrementing = false;
    protected $fillable = ['encabezadoMede', 'slug'];

    public function getRouteKeyName()
    {
        return "slug";
    }
}
