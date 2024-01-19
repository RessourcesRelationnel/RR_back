<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'title'=> ['string','required'],
            'content'=> ['string', 'required'],
            'img'=> ['mimes:jpg,bmp,png', 'max:1024'],
            'media'=> ['mimes:pdf' ],
            'categories_id'=> ['required', 'string'],

        ];
    }
}
