<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CambioRequest extends FormRequest
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
            'lectura_retiro' => 'required|numeric',
            'medidor' => 'required',
            'varales' => 'required',
            'nombre_cliente' => 'required',
            'rut_cliente' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'lectura_retiro.required' => 'Debe ingresar una lectura de retiro',
            'lectura_retiro.numeric' => 'Lectura ingresada no es un número válido',
            'medidor.required' => 'Debe seleccionar un medidor',
            'varales.required' =>'Debe ingresar Varales',
            'nombre_cliente.required' =>'Debe ingresar el Nombre del cliente',
            'rut_cliente.required' =>'Debe ingresar el Rut del cliente'
        ];
    }
}
