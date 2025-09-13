<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'       => ['nullable', 'string', 'max:255'],
            'slug'       => ['nullable', 'string', 'max:255'],
            'is_active'  => ['nullable', 'boolean'],
            'parent_id'  => ['nullable', 'integer', 'exists:categories,id'],
            'limit'      => ['nullable', 'integer', 'min:1', 'max:100'],
            'offset'     => ['nullable', 'integer', 'min:0'],
        ];
    }
}
