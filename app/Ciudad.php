<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
  public $incrementing = false;
  protected $fillable = ['detciudad', 'slug'];

  public function getRouteKeyName()
  {
    return "slug";
  }
  //Relacion Uno a Muchos 
  public function estandar()
  {
    return $this->hasMany(Estandar::class);
  }
}
