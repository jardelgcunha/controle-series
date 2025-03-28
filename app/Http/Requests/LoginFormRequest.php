<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => "O campo 'Email' é obrigatório.",
            'password.required' => "O campo 'Senha' é obrigatório.",
            'password.min' => "O campo 'Senha' precisa de pelo menos :min caracteres.",
        ];
    }
}
