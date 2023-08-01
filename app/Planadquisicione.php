<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planadquisicione extends Model
{   
    protected $fillable= [
        'fechaInicial',
        'fechaFinal',
        'caja',
        'carpeta',
        'tomo',
        'otro',
        'folio',
        'nota',
        'modalidad_id',
        'segmento_id',
        'familias_id',
        'area_id',
        'requiproyecto_id',
        'requipoais_id',
        'fuente_id',
        'tipoprioridade_id',
        'user_id',
        'slug'       
    ];

    public function getRouteKeyName() {
      return "slug";
    }

    //Relacion Uno a Muchos (Inversa)
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Relacion Uno a Muchos (Inversa)
    public function fuente(){
        return $this->belongsTo(Fuente::class);
    }

    //Relacion Uno a Muchos (Inversa)
    public function requiproyecto(){
        return $this->belongsTo(Requiproyecto::class);
    }

    //Relacion Uno a Muchos (Inversa)
    public function requipoais(){
        return $this->belongsTo(Requipoai::class);
    }

    //Relacion Uno a Muchos (Inversa)
    public function tipoprioridade(){
        return $this->belongsTo(Tipoprioridade::class);
    }

    //Relacion Uno a Muchos (Inversa)
   public function area(){
      return $this->belongsTo(Area::class);
    }

    //Relacion Uno a Muchos (Inversa)
   public function segmento(){
      return $this->belongsTo(Segmento::class);
    }
   
    //Relacion Uno a Muchos (Inversa)
   public function modalidad(){
      return $this->belongsTo(Modalidade::class);
    }
    
    //Relacion Uno a Muchos (Inversa)
   public function familias(){
      return $this->belongsTo(Familia::class);
    }
    
    //Relacion Muchos a Muchos

    // public function detalleplanadquisiciones(){
    //     return $this->hasMany(Detalleplanadquisicione::class);
    // }
}
