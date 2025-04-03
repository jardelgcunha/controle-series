<?php

namespace App\Http\Requests;

use AllowDynamicProperties;
use Illuminate\Foundation\Http\FormRequest;

#[AllowDynamicProperties] class SeriesFormRequest extends FormRequest
{
    /**
     * @var false|mixed|string
     */
    public mixed $coverPath = null;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                'seasonsQty' => ['required', 'integer', 'min:1'],
                'episodesPerSeason' => ['required', 'integer', 'min:1'],
            ];
        }
        return [
            'name' => ['required', 'min:3'],
            'cover' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "O campo 'nome' é obrigatório.",
            'name.min' => "O campo 'nome' precisa de pelo menos :min caracteres.",
            'seasonsQty.required' => "O campo 'temporadas' é obrigatório.",
            'seasonsQty.min' => "O campo 'temporadas' precisa de pelo menos :min caracteres.",
            'episodesPerSeason.required' => "O campo 'episódios' é obrigatório.",
            'episodesPerSeason.min' => "O campo 'episódios' precisa de pelo menos :min caracteres.",
        ];
    }
}
