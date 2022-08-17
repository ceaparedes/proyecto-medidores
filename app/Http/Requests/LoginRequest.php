<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'username' => 'required|max:40',
            'password' => 'required',
        ];
    }

    public function messages(){

        return [
            'username.required' => 'Debe ingresar un usuario',
            'username.max' => 'El usuario supera las 40 caracteres',
            'password.required' => 'Debe ingresar una contraseña',
        ];
    }
}
