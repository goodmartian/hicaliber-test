<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertySearchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255'],
            'bedrooms' => ['nullable', 'integer', 'min:0', 'max:255'],
            'bathrooms' => ['nullable', 'integer', 'min:0', 'max:255'],
            'storeys' => ['nullable', 'integer', 'min:0', 'max:255'],
            'garages' => ['nullable', 'integer', 'min:0', 'max:255'],
            'price_min' => ['nullable', 'integer', 'min:0'],
            'price_max' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
