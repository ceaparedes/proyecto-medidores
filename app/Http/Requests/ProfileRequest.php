<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'old_password' =>'required',
            'password' => 'required|confirmed|password',
        ];
    }

    public function messages(){

        return [
            'name.required' => 'Debe ingresar un Usuario',
            'email.required' => 'Debe ingresar un Email',
            'email.email' => 'Debe ingresar un Email válido',
            'username.required' => 'Debe ingresar un Nombre de usuario',
            'old_password.required' => 'Debe ingresar Su contraseña actual',
            'password.required' => 'Debe ingresar una nueva contraseña',
            'password.confirmed' => 'Las contraseñas ingresadas no coinciden',
            'password.password' => 'Las contraseña debe contener letras y números',

        ];
    }
}
