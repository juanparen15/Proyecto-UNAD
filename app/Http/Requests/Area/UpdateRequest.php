<?php

namespace App\Http\Requests\Area;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'nomarea' => 'unique:areas,nomarea,'.$this->route('area')->id.'|required',
           'dependencia_id'=>'integer|required|exists:App\Dependencia,id',

        ];
    }
    public function messages()
    {
        return[
            'nomarea.required'=> 'Este Campo es Requerido',
            'dependencia_id.required'=>'Este Campo es Requerido',
           
        ];
        
    }
}
