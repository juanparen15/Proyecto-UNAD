<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requiproyecto extends Model
{
  public $incrementing = false;
  protected $fillable = ['id', 'detproyeto', 'areas_id', 'slug'];

  public function getRouteKeyName()
  {
    return "slug";
  }
  // Relacion Uno a Muchos (Inversa)
  public function area()
  {
    return $this->belongsTo(Area::class, 'areas_id');
  }
  //Relacion Uno a Muchos
  public function planadquisiciones()
  {
    return $this->hasMany(Planadquisicione::class);
  }
}
