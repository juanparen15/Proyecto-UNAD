<?php

namespace App\Http\Requests\Requipoai;

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
            'detpoai' => 'required',
            'slug' => 'required|unique:requipoais'// alt+124=|
        ];
    }
    public function messages()
    {
        return[
            'detpoai.required'=> 'Este Campo es Requerido',            
            'slug.required'=> 'Este Campo es Requerido', 
        ];
    }
}
