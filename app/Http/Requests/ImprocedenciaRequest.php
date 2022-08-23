<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImprocedenciaRequest extends FormRequest
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
            'improcedencia' => 'required',
            // 'imagen.*' =>'file|mimes:jpg,jpeg,png|size:10000'
        ];
    }

    public function messages(){

        return [
            'improcedencia.required' => 'Debe ingresar una causa',
            // 'imagen.file' => 'Debe ingresar una imagen',
            // 'archivo.size' => 'El archivo excede el maximo permitido (10mb)',
            // 'archivo.mimes' => 'la(s) imagen(es) estan en un formato incorrecto, (debe ser jpg jpeg, png)'
        ];
    }
}
