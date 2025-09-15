<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Puedes restringir solo a admins
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // password_confirmation
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
