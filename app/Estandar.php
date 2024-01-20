<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estandar extends Model
{
  public $incrementing = false;
  protected $fillable = ['ciudad_id', 'detestandar', 'slug'];

  public function getRouteKeyName()
  {
    return "slug";
  }

  //Relacion Uno a Muchos (Inversa)
  public function ciudad()
  {
    return $this->belongsTo(Ciudad::class);
  }


}