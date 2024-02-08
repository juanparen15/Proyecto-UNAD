<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emisora extends Model
{
    // public $incrementing = false;
    protected $fillable = ['id', 'tipoemisora_id', 'emisora', 'slug'];
  
    protected $with =[
      'fuente',
  ];
    public function getRouteKeyName()
    {
      return "slug";
    }
    //Relacion Uno a Muchos
    public function planadquisiciones()
    {
      return $this->hasMany(Planadquisicione::class);
    }
    public function fuente()
    {
      return $this->belongsTo(Fuente::class, 'tipoemisora_id');
    }
  }