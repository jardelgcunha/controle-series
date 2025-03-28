<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'min:2'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "O campo 'Nome' é obrigatório.",
            'name.min' => "O campo 'Nome' precisa de pelo menos :min caracteres.",
            'email.required' => "O campo 'Email' é obrigatório.",
            'password.required' => "O campo 'Senha' é obrigatório.",
            'password.min' => "O campo 'Senha' precisa de pelo menos :min caracteres.",
        ];
    }
}
