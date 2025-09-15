<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Ajusta según roles
    }

    public function rules(): array
    {
        $userId = $this->route('user'); // Asumiendo route model binding

        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'email', Rule::unique('users', 'email')->ignore($userId)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'phone' => ['nullable', 'string', 'max:20'],
            'status' => ['nullable', 'in:active,inactive'],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['string', 'exists:roles,name'],
        ];
    }

    public function toDTO(): \App\Application\DTOs\UserDTO
    {
        $data = $this->validated();
        $data['permissions'] = []; // Se asignan permisos vía roles
        return \App\Application\DTOs\UserDTO::fromArray($data);
    }
}
