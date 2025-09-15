<?php

namespace App\Domain\RepositoriesInterface;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface BaseRepositoryInterface
{
    /**
     * Listar con filtros y paginación
     */
    public function list(array $filters = [], int $perPage = 15): LengthAwarePaginator;

    /**
     * Buscar por ID
     */
    public function findById(int $id): ?object;

    /**
     * Crear un nuevo registro
     */
    public function create(array $data): object;

    /**
     * Actualizar un registro existente
     */
    public function update(int $id, array $data): object;

    /**
     * Eliminar un registro (soft delete)
     */
    public function delete(int $id): bool;

    /**
     * Restaurar un registro eliminado
     */
    public function restore(int $id): ?object;

    /**
     * Obtener todos los registros activos
     */
    public function all(): Collection;

    public function paginate($modelo, $perPage): LengthAwarePaginator;
        
}
