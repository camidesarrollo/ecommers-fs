<?php

namespace App\Application\DTOs;

class UserDTO
{
    public ?int $id;
    public string $name;
    public string $email;
    public ?string $password;
    public ?string $phone;
    public ?string $status; // 'active', 'inactive', etc.
    public ?string $avatar;
    public array $roles;
    public array $permissions;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->password = $data['password'] ?? null;
        $this->phone = $data['phone'] ?? null;
        $this->status = $data['status'] ?? 'active';
        $this->avatar = $data['avatar'] ?? null;
        $this->roles = $data['roles'] ?? [];
        $this->permissions = $data['permissions'] ?? [];
    }

    /**
     * Crear DTO desde array (request validated o modelo)
     */
    public static function fromArray(array $data): self
    {
        return new self([
            'id'          => $data['id'] ?? null,
            'name'        => $data['name'],
            'email'       => $data['email'],
            'password'    => $data['password'] ?? null,
            'phone'       => $data['phone'] ?? null,
            'status'      => $data['status'] ?? 'active',
            'avatar'      => $data['avatar'] ?? null,
            'roles'       => $data['roles'] ?? [],
            'permissions' => $data['permissions'] ?? [],
        ]);
    }

    /**
     * Convertir a array listo para guardar o actualizar
     */
    public function toArray(): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'email'       => $this->email,
            'password'    => $this->password,
            'phone'       => $this->phone,
            'status'      => $this->status,
            'avatar'      => $this->avatar,
            'roles'       => $this->roles,
            'permissions' => $this->permissions,
        ];
    }
}
