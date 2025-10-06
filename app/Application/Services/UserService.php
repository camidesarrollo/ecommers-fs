<?php

namespace App\Application\Services;

use App\Domain\Models\User;
use App\Application\DTOs\UserDTO;
use App\Application\DTOs\UserFilterDTO;
use App\Domain\RepositoriesInterface\UserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Infrastructure\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Listar usuarios con filtros
     */
    public function listUsers(array|UserFilterDTO $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->userRepository->list($filters, $perPage);
    }

    /**
     * Crear un usuario
     */
    public function createUser(array|UserDTO $data): User
    {
        return $this->userRepository->create($data);
    }

    /**
     * Actualizar un usuario
     */
    public function updateUser(int|User $id, array|UserDTO $data): User
    {
        return $this->userRepository->update($id, $data);
    }

    /**
     * Buscar usuario por ID
     */
    public function findUserById(int $id): ?User
    {
        return $this->userRepository->findById($id);
    }

    /**
     * Eliminar un usuario (soft delete)
     */
    public function deleteUser(int $id): bool
    {
        return $this->userRepository->delete($id);
    }

    /**
     * Restaurar usuario eliminado
     */
    public function restoreUser(int $id): ?User
    {
        return $this->userRepository->restore($id);
    }

    /**
     * Obtener todos los usuarios activos
     */
    public function getAllActiveUsers(): \Illuminate\Support\Collection
    {
        return $this->userRepository->all();
    }

    public function register(array|UserDTO $data): User
    {
         return $this->userRepository->register($data);
    }

    public function findByEmail(string $email): ?User
    {
            return $this->userRepository->findByEmail($email);
    }

    /**
     * Login de usuario
     * @param string $email
     * @param string $password
     * @param string|null $deviceName
     * @return array|null
     * @throws \Exception
     */

    public function login(string $email, string $password, ?string $deviceName = null): array
    {
       return $this->userRepository->login($email,  $password, $deviceName);
    }

    public function loginGoogle(array $data): array
    {
       return $this->userRepository->loginGoogle($data);
    }
}
