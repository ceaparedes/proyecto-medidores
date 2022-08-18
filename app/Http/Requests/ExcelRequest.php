<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExcelRequest extends FormRequest
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
            'archivo' => 'required|mimes:xls,xlsx',
        ];
    }

    public function messages(){

        return [
            'archivo.required' => 'Debe ingresar un Excel',
            'archivo.file' => 'Debe ingresar un Excel',
            'archivo.size' => 'El archivo excede el maximo permitido (10mb)',
            'archivo.mimes' => 'El archivo esta en un formato Incorrecto, (debe ser xls o xlsx)'
        ];
    }
}
