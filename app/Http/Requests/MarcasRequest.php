<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarcasRequest extends FormRequest
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
            'nombre' => 'required',
            'abreviatura' => 'required',
            'estado' => 'required|boolean'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Debe ingresar un nombre',
            'abreviatura.required' => 'Debe ingresar una abreviatura',
            'estado.required' => 'Debe ingresar un estado',
            'estado.boolean' => 'Debe ingresar un estado válido (activo o inactivo)',
        ];
    }
}
