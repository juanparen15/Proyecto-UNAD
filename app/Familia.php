<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
  public $incrementing = false;
  protected $fillable = ['id', 'ciudad_id', 'detfamilia', 'slug'];

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
