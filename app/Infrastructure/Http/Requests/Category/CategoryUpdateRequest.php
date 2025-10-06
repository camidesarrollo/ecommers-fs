<?php

namespace App\Infrastructure\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $category_id = $this->route('id');

        return [
            'name'        => ['sometimes', 'required', 'string', 'max:255'],
            'slug'        => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'slug')->ignore($category_id),
            ],
            'description' => ['nullable', 'string'],
            'image'       => ['nullable', 'string'],
            'bg_class'    => ['nullable', 'string', 'max:100'],
            'sort_order'  => ['nullable', 'integer'],
            'is_active'   => ['nullable', 'boolean'],
            'parent_id'   => ['nullable', 'integer', 'exists:categories,id'],
        ];
    }
}
