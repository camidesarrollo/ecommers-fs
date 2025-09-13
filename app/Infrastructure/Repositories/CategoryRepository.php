<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Category;
use App\Domain\RepositoriesInterface\CategoryRepositoryInterface;
use App\Application\DTOs\CategoryDTO;
use App\Application\DTOs\CategoryFilterDTO;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * Listar categorías con filtros específicos
     */
    public function list(array|CategoryFilterDTO $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Category::query();

        // Si los filtros vienen como DTO, convertir a array
        if ($filters instanceof CategoryFilterDTO) {
            $filtersArray = $filters->toArray();
        } else {
            $filtersArray = $filters;
        }

        $this->applyFilters($query, $filtersArray);

        return $query->paginate($perPage);
    }

    /**
     * Buscar por ID
     */
    public function findById(int $id): ?Category
    {
        return Category::find($id);
    }

    /**
     * Crear categoría
     */
    public function create(array|CategoryDTO $data): Category
    {
        // Si los datos vienen como DTO, convertir a array
        if ($data instanceof CategoryDTO) {
            $dataArray = $data->toArray();
        } else {
            $dataArray = $data;
        }

        return Category::create($dataArray);
    }

    /**
     * Actualizar categoría
     */
    public function update(int|Category $id, array|CategoryDTO $data): Category
    {
        // Obtener la categoría si se pasa un ID
        if (is_int($id)) {
            $category = Category::findOrFail($id);
        } else {
            $category = $id;
        }

        // Si los datos vienen como DTO, convertir a array
        if ($data instanceof CategoryDTO) {
            $dataArray = $data->toArray();
        } else {
            $dataArray = $data;
        }

        $category->update($dataArray);

        return $category->fresh();
    }

    /**
     * Eliminar categoría (soft delete)
     */
    public function delete(int $id): bool
    {
        $category = Category::findOrFail($id);
        return $category->delete();
    }

    /**
     * Restaurar categoría eliminada
     */
    public function restore(int $id): ?Category
    {
        $category = Category::withTrashed()->find($id);

        if ($category && $category->trashed()) {
            $category->restore();
            return $category;
        }

        return null;
    }

    /**
     * Buscar por slug
     */
    public function findBySlug(string $slug): ?Category
    {
        return Category::where('slug', $slug)->first();
    }

    /**
     * Obtener todas las categorías activas (sin paginación)
     */
    public function allActive(): Collection
    {
        return Category::where('is_active', true)
            ->orderBy('name')
            ->get();
    }

    /**
     * Obtener todos los registros activos
     */
    public function all(): Collection
    {
        return Category::all();
    }

    /**
     * Paginar modelo
     */
    public function paginate($modelo): LengthAwarePaginator
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
            $query = Category::query();
        }

        return $query->paginate(15);
    }

    /**
     * Aplicar filtros a la consulta
     */
    private function applyFilters(Builder $query, array $filters): void
    {
        if (isset($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (isset($filters['slug'])) {
            $query->where('slug', 'like', '%' . $filters['slug'] . '%');
        }

        if (isset($filters['is_active'])) {
            $query->where('is_active', $filters['is_active']);
        }

        if (isset($filters['parent_id'])) {
            if ($filters['parent_id'] === null) {
                $query->whereNull('parent_id');
            } else {
                $query->where('parent_id', $filters['parent_id']);
            }
        }

        if (isset($filters['created_from'])) {
            $query->whereDate('created_at', '>=', $filters['created_from']);
        }

        if (isset($filters['created_to'])) {
            $query->whereDate('created_at', '<=', $filters['created_to']);
        }

        if (isset($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('slug', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // Ordenamiento por defecto
        if (!isset($filters['order_by'])) {
            $query->orderBy('name', 'asc');
        } else {
            $orderDirection = $filters['order_direction'] ?? 'asc';
            $query->orderBy($filters['order_by'], $orderDirection);
        }
    }
}
