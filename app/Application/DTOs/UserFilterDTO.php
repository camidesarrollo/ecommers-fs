<?php

namespace App\Application\DTOs;

class UserFilterDTO
{
    public ?string $name;
    public ?string $apellido;
    public ?string $email;
    public ?string $rut;
    public ?string $pasaporte;
    public ?string $role;
    public ?bool $status; // true = activo, false = inactivo
    public ?int $perPage;
    public ?int $page;

    public function __construct(array $filters = [])
    {
        $this->name = $filters['name'] ?? null;
        $this->apellido = $filters['apellido'] ?? null;
        $this->email = $filters['email'] ?? null;
        $this->rut = $filters['rut'] ?? null;
        $this->pasaporte = $filters['pasaporte'] ?? null;
        $this->role = $filters['role'] ?? null;
        $this->status = $filters['status'] ?? null;
        $this->perPage = $filters['per_page'] ?? 15;
        $this->page = $filters['page'] ?? 1;
    }

    /**
     * Convertir DTO a array
     */
    public function toArray(): array
    {
        return [
            'name'       => $this->name,
            'apellido'   => $this->apellido,
            'email'      => $this->email,
            'rut'        => $this->rut,
            'pasaporte'  => $this->pasaporte,
            'role'       => $this->role,
            'status'     => $this->status,
            'perPage'    => $this->perPage,
            'page'       => $this->page,
        ];
    }
}
