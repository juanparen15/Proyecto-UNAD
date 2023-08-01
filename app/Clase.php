<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    public $incrementing = false;
    protected $fillable= [
        'id',
        'detclase',
        'slug',
        'familia_id'
    ];

    public function getRouteKeyName() {
      return "slug";
    } 
     
    //Relacion Uno a Muchos (Inversa)
    public function familia(){
        return $this->belongsTo(Familia::class);
    }

    //Relacion Uno a Muchos 
    public function producto(){
        return $this->hasMany(Producto::class);
    }
}
