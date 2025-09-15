<?php

namespace App\Application\Services;

use App\Domain\Models\Category;
use App\Domain\RepositoriesInterface\CategoryRepositoryInterface;
use App\Application\DTOs\CategoryDTO;
use App\Application\DTOs\CategoryFilterDTO;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryService
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Crear una nueva categoría
     */
    public function create(CategoryDTO $dto): Category
    {
        return $this->categoryRepository->create($dto);
    }

    /**
     * Actualizar una categoría existente
     */
    public function update(int $id, CategoryDTO $dto): Category
    {
        return $this->categoryRepository->update($id, $dto);
    }

    /**
     * Eliminar una categoría
     */
    public function delete(int $id): bool
    {
        return $this->categoryRepository->delete($id);
    }

    /**
     * Buscar categoría por ID
     */
    public function findById(int $id): ?Category
    {
        return $this->categoryRepository->findById($id);
    }

    /**
     * Buscar categoría por slug
     */
    public function findBySlug(string $slug): ?Category
    {
        return $this->categoryRepository->findBySlug($slug);
    }

    /**
     * Obtener todas las categorías activas
     */
    public function allActive(): Collection
    {
        return $this->categoryRepository->allActive();
    }

    /**
     * Obtener categorías filtradas y paginadas
     */
    public function paginate(CategoryFilterDTO $filter): LengthAwarePaginator
    {

        return $this->categoryRepository->paginate(null,
            $filter->perPage
        );
    }
}
