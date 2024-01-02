<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fuente extends Model
{
  // public $incrementing = false;
  protected $fillable = ['id', 'familias_id', 'detfuente', 'slug'];

  public function getRouteKeyName()
  {
    return "slug";
  }
  //Relacion Uno a Muchos
  public function planadquisiciones()
  {
    return $this->hasMany(Planadquisicione::class);
  }
  public function familia()
  {
    return $this->belongsTo(Familia::class);
  }
}
