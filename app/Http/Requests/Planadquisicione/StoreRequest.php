<?php

namespace App\Http\Requests\Planadquisicione;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'caja'=> 'required',
            'carpeta'=> 'required',
            'tomo'=> 'required',
            'otro'=> 'required',
            'folio'=> 'required',
            'nota'=> 'required',
            'modalidad_id'=> 'required',
            'fuente_id'=> 'required',
            'tipoprioridade_id'=> 'required',
            'requiproyecto_id'=> 'required',
            'segmento_id'=> 'required',
            'familias_id'=> 'required',
            'fechaInicial'=> 'required',
            'fechaFinal'=> 'required',
            'area_id'=> 'required'
        ];
    }
}
