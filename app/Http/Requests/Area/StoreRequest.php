<?php

namespace App\Http\Requests\Area;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Exists;

class StoreRequest extends FormRequest
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
            'nomarea' => 'required|unique:areas',
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
