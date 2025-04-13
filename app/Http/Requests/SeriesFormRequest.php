<?php

namespace App\Http\Requests;

use AllowDynamicProperties;
use Illuminate\Foundation\Http\FormRequest;

#[AllowDynamicProperties] class SeriesFormRequest extends FormRequest
{
    public mixed $coverPath = null;

    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'min:3'],
            'cover' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];

        if ($this->isMethod('post') && $this->getContentTypeFormat() === 'form') {
            $rules['seasonsQty'] = ['required', 'integer', 'min:1'];
            $rules['episodesPerSeason'] = ['required', 'integer', 'min:1'];
        }

        return $rules;
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
