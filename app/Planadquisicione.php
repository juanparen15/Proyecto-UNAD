<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Planadquisicione extends Model
{
    protected $fillable = [
        'fechaInicial',
        'fechaFinal',
        'caja',
        'carpeta',
        'tomo',
        'otro',
        'folio',
        'nota',
        'modalidad_id',
        'ciudad_id',
        'familia_id',
        'area_id',
        'requiproyecto_id',
        'requipoais_id',
        'fuente_id',
        'tipoprioridade_id',
        'user_id',
        'slug'
    ];
    protected $with =[
        'user',
        'fuente',
        'requiproyecto',
        'requipoais',
        'tipoprioridade',
        'area',
        'ciudad',
        'modalidad',
        'familias'
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
    public function fuente()
    {
        return $this->belongsTo(Fuente::class);
    }

    //Relacion Uno a Muchos (Inversa)
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    //Relacion Uno a Muchos (Inversa)
    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class);
    }
    //Relacion Uno a Muchos (Inversa)
    public function familias()
    {
        return $this->belongsTo(Familia::class);
    }

    //Relacion Muchos a Muchos

    // public function detalleplanadquisiciones(){
    //     return $this->hasMany(Detalleplanadquisicione::class);
    // }
}
