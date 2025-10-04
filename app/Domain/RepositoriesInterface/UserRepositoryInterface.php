<?php

namespace App\Domain\RepositoriesInterface;

use App\Domain\Models\User;
use App\Application\DTOs\UserDTO;
use App\Application\DTOs\UserFilterDTO;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Listar registros de historial de precios con filtros específicos
     */
    public function list(array|UserFilterDTO $filters = [], int $perPage = 15): LengthAwarePaginator;

    /**
     * Crear un registro del historial de precios
     */
    public function create(array|UserDTO $data): User;

    /**
     * Actualizar un registro del historial de precios
     * @param int|User $id
     * @param array|UserDTO $data
     */
    public function update(int|User $id, array|UserDTO $data): User;

    /**
     * Obtener un registro por ID
     */
    public function findById(int $id): ?User;

    public function register(array|UserDTO $data): ?User;

    public function findByEmail(string $email): ?User;

    public function login(string $email, string $password, ?string $deviceName = null): ?array;
    
    public function loginGoogle(array $data): array;
}