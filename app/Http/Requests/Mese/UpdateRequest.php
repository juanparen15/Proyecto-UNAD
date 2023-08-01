<?php

namespace App\Http\Requests\Mese;

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
            'nommes' => 'required',
            'slug' => 'required|unique:meses'// alt+124=|
        ];
    }
    public function messages()
    {
        return[
            'nommes.required'=> 'Este Campo es Requerido',
            'slug.required'=> 'Este Campo es Requerido',  
        ];
    }
}
