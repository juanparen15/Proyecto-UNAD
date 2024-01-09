<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encabezado extends Model
{
    public $incrementing = false;
    protected $fillable = ['encabezado', 'slug'];

    public function getRouteKeyName()
    {
        return "slug";
    }
}
