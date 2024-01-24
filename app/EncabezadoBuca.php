<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EncabezadoBuca extends Model
{
    public $incrementing = false;
    protected $fillable = ['encabezadoBuca', 'slug'];

    public function getRouteKeyName()
    {
        return "slug";
    }
}
