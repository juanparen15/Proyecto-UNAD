<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EncabezadoCali extends Model
{
    public $incrementing = false;
    protected $fillable = ['encabezadoCali', 'slug'];

    public function getRouteKeyName()
    {
        return "slug";
    }
}
