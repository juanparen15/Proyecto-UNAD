<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Planadquisicione extends Model
{
    protected $fillable = [
        'kmz',
        'coordenadaX',
        'coordenadaY',
        // 'area_id',
        'tipoemisora_id',
        // 'emisora_id',
        'user_id',
        'slug'
    ];
    protected $with =[
        'user',
        'tipo',
        'area',
        'emisora',
        'estandar',
    ];

    // public function show($id, $slug)
    // {
    //     // Buscar el plan de adquisición por ID y Slug
    //     $planAdquisicion = Planadquisicione::where('id', $id)
    //         ->where('slug', $slug)
    //         ->firstOrFail();
    
    //     // Resto de tu lógica para mostrar el plan de adquisición
    // }

    public function getRouteKeyName()
    {
        return "slug";
    }

    //Relacion Uno a Muchos (Inversa)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Relacion Uno a Muchos (Inversa)
    public function estandar()
    {
        return $this->belongsTo(Estandar::class, 'estandar_id');
    }
    
    //Relacion Uno a Muchos (Inversa)
    public function tipo()
    {
        return $this->belongsTo(TipoSimulacion::class, 'tipoemisora_id');
    }

    //Relacion Uno a Muchos (Inversa)
    public function emisora()
    {
        return $this->belongsTo(Emisora::class, 'emisora_id');
    }

    //Relacion Uno a Muchos (Inversa)
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    //Relacion Uno a Muchos (Inversa)
    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'ciudad_id'); // Asegúrate de que el nombre de la clave foránea sea correcto
    }
    //Relacion Muchos a Muchos

    // public function detalleplanadquisiciones(){
    //     return $this->hasMany(Detalleplanadquisicione::class);
    // }
}
