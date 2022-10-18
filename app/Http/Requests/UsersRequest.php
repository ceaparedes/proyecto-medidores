<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'estado' => 'required|boolean'
        ];
    }

    public function messages(){

        return [
            'name.required' => 'Debe ingresar un Usuario',
            'email.required' => 'Debe ingresar un Email',
            'email.email' => 'Debe ingresar un Email válido',
            'username.required' => 'Debe ingresar un Nombre de usuario',
            'estado.required' => 'Debe ingresar un Estado',
            'estado.boolean' => 'Debe ingresar un Estado válido',

        ];
    }
}
