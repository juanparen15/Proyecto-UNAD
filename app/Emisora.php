<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emisora extends Model
{
  public $incrementing = false;
  public $table = 'emisoras';
  public $connection = 'mysql';
    protected $fillable = ['id', 'tipoemisora_id', 'emisora', 'slug'];
  
    protected $with =[
      'tipo',
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
    public function tipo()
    {
      return $this->belongsTo(TipoSimulacion::class, 'tipoemisora_id');
    }
  }