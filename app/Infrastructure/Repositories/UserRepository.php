<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\User;
use App\Domain\RepositoriesInterface\UserRepositoryInterface;
use App\Application\DTOs\UserDTO;
use App\Application\DTOs\UserFilterDTO;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

class UserRepository implements UserRepositoryInterface
{
    protected Builder $model;

    public function __construct()
    {
        $this->model = User::query();
    }

    /**
     * Listar usuarios con filtros y paginación
     */
    public function list(array|UserFilterDTO $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        if ($filters instanceof UserFilterDTO) {
            $filters = $filters->toArray();
        }

        $query = $this->model->newQuery();

        if (!empty($filters['name'])) {
            $query->where('name', 'like', "%{$filters['name']}%");
        }

        if (!empty($filters['email'])) {
            $query->where('email', 'like', "%{$filters['email']}%");
        }

        if (!empty($filters['role'])) {
            $query->whereHas('roles', function (Builder $q) use ($filters) {
                $q->where('name', $filters['role']);
            });
        }

        if (isset($filters['status'])) {
            $query->where('status', $filters['status'] ? 'active' : 'inactive');
        }

        $perPage = $filters['perPage'] ?? $perPage;

        return $query->paginate($perPage);
    }

    /**
     * Crear un usuario
     */
    public function create(array|UserDTO $data): User
    {
        if ($data instanceof UserDTO) {
            $data = $data->toArray();
        }

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'] ?? null;
        $user->status = $data['status'] ?? 'active';
        $user->avatar = $data['avatar'] ?? null;
        if (!empty($data['password'])) {
            $user->password = bcrypt($data['password']);
        }
        $user->save();

        if (!empty($data['roles'])) {
            $user->syncRoles($data['roles']);
        }

        return $user;
    }

    /**
     * Actualizar un usuario
     */
    public function update(int|User $id, array|UserDTO $data): User
    {
        $user = $id instanceof User ? $id : $this->findById($id);

        if (!$user) {
            throw new \Exception("Usuario no encontrado.");
        }

        if ($data instanceof UserDTO) {
            $data = $data->toArray();
        }

        $user->fill([
            'name' => $data['name'] ?? $user->name,
            'email' => $data['email'] ?? $user->email,
            'phone' => $data['phone'] ?? $user->phone,
            'status' => $data['status'] ?? $user->status,
            'avatar' => $data['avatar'] ?? $user->avatar,
        ]);

        if (!empty($data['password'])) {
            $user->password = bcrypt($data['password']);
        }

        $user->save();

        if (isset($data['roles'])) {
            $user->syncRoles($data['roles']);
        }

        return $user;
    }

    /**
     * Buscar un usuario por ID
     */
    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    /**
     * Eliminar usuario (soft delete)
     */
    public function delete(int $id): bool
    {
        $user = $this->findById($id);
        if (!$user) {
            return false;
        }
        return $user->delete();
    }

    /**
     * Restaurar usuario eliminado
     */
    public function restore(int $id): ?User
    {
        $user = User::withTrashed()->find($id);
        if ($user) {
            $user->restore();
            return $user;
        }
        return null;
    }

    /**
     * Obtener todos los usuarios activos
     */
    public function all(): Collection
    {
        return User::where('status', 'active')->get();
    }

        /**
     * Paginación genérica
     */
    public function paginate($modelo, $perPage): LengthAwarePaginator
    {
        // Si es un Query Builder
        if ($modelo instanceof \Illuminate\Database\Eloquent\Builder) {
            $query = $modelo;
        }
        // Si es un string que representa un modelo
        elseif (is_string($modelo) && class_exists($modelo)) {
            $query = $modelo::query();
        }
        // Por defecto usamos Category::query()
        else {
            $query = User::query();
        }

        return $query->paginate($perPage);
    }
}
