<?php

namespace App\Application\DTOs;

use App\Domain\Models\User;

class UserDTO
{
    public ?int $id;
    public ?string $name;
    public ?string $apellido;
    public string $email;
    public ?string $phone;
    public string $status;
    public ?string $avatar;
    public ?string $password;
    public ?string $rut;
    public ?string $pasaporte;
    public array $roles;
    public array $permissions;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->apellido = $data['apellido'] ?? null;
        $this->email = $data['email'] ?? '';
        $this->password = $data['password'] ?? null;
        $this->phone = $data['phone'] ?? null;
        $this->status = $data['status'] ?? 'active';
        $this->avatar = $data['avatar'] ?? null;
        $this->rut = $data['rut'] ?? null;
        $this->pasaporte = $data['pasaporte'] ?? null;
        $this->roles = $data['roles'] ?? [];
        $this->permissions = $data['permissions'] ?? [];
    }

    public static function fromModel(User $user): self
    {
        return new self([
            'id' => $user->id,
            'name' => $user->name,
            'apellido' => $user->apellido ?? null,
            'email' => $user->email,
            'password' => null, // nunca exponer la password
            'phone' => $user->phone ?? null,
            'status' => $user->status,
            'avatar' => $user->avatar ?? null,
            'rut' => $user->rut ?? null,
            'pasaporte' => $user->pasaporte ?? null,
            'roles' => $user->getUserRoles(),
            'permissions' => $user->getUserPermissions(),
        ]);
    }

    public static function fromArray(array $data): self
    {
        return new self([
            'id' => $data['id'] ?? null,
            'name' => $data['name'] ?? null,
            'apellido' => $data['apellido'] ?? null,
            'email' => $data['email'] ?? '',
            'password' => $data['password'] ?? null,
            'phone' => $data['phone'] ?? null,
            'status' => $data['status'] ?? 'active',
            'avatar' => $data['avatar'] ?? null,
            'rut' => $data['rut'] ?? null,
            'pasaporte' => $data['pasaporte'] ?? null,
            'roles' => $data['roles'] ?? [],
            'permissions' => $data['permissions'] ?? [],
        ]);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'apellido' => $this->apellido,
            'email' => $this->email,
            'password' => $this->password,
            'phone' => $this->phone,
            'status' => $this->status,
            'avatar' => $this->avatar,
            'rut' => $this->rut,
            'pasaporte' => $this->pasaporte,
            'roles' => $this->roles,
            'permissions' => $this->permissions,
        ];
    }
}
