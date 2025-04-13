<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SeriesApiFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // permite acesso à request sem autenticação por padrão
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'cover' => ['nullable', 'image', 'max:2048'], // até 2MB
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "O campo 'nome' é obrigatório.",
            'name.min' => "O campo 'nome' precisa de pelo menos :min caracteres.",
        ];
    }
}
