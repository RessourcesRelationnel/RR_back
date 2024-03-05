<?php

namespace App\Http\Requests\article;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorearticlesRequest extends FormRequest
{
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
        return [
            'title' => ['required', 'string'],
            'content' => ['required', 'string'],
            'img' => ['nullable', 'image', 'max:1024'], // Permettre une valeur nulle pour l'image
            'media' => ['nullable', 'mimes:pdf'], // Permettre une valeur nulle pour le média
            'user_id' => ['required', 'string', Rule::exists('users', 'id')],
            'categories' => ['required', 'string', Rule::exists('categories', 'id')],
            // quand on enverra un tableau depuis le front
            // 'categories' => ['required', 'array'],
            // 'categories.*.id' => ['required', 'string', Rule::exists('categories', 'id')],
        ];
    }
}