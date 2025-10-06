<?php

namespace App\Infrastructure\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginGoogleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'token' => ['required', 'string'],
            'device_name' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'token.required' => 'El token de Google es obligatorio.',
        ];
    }
}
