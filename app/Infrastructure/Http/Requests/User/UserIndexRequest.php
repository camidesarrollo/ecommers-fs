<?php

namespace App\Infrastructure\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Ajusta según roles
    }

    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'role' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'boolean'],
            'per_page' => ['nullable', 'integer', 'min:1'],
            'page' => ['nullable', 'integer', 'min:1'],
        ];
    }

    /**
     * Transform request data into UserFilterDTO
     */
    public function toDTO(): \App\Application\DTOs\UserFilterDTO
    {
        return new \App\Application\DTOs\UserFilterDTO($this->validated());
    }
}
