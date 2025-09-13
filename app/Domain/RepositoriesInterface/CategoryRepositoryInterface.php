<?php

namespace App\Domain\RepositoriesInterface;

use App\Domain\Models\Category;
use App\Application\DTOs\CategoryDTO;
use App\Application\DTOs\CategoryFilterDTO;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Listar categorías con filtros específicos
     * Using union types to maintain compatibility
     */
    public function list(array|CategoryFilterDTO $filters = [], int $perPage = 15): LengthAwarePaginator;

    /**
     * Crear categoría - compatible with parent interface
     */
    public function create(array|CategoryDTO $data): Category;

    /**
     * Actualizar categoría - compatible with parent interface  
     */
    public function update(int|Category $id, array|CategoryDTO $data): Category;

    /**
     * Buscar por slug
     */
    public function findBySlug(string $slug): ?Category;

    /**
     * Obtener todas las categorías activas (sin paginación)
     */
    public function allActive(): Collection;

    // Métodos restore, delete y getFeatured ya vienen de BaseRepositoryInterface
}