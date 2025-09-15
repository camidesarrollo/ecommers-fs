<?php

namespace App\Application\Services;

use App\Domain\Models\Product;
use App\Domain\RepositoriesInterface\ProductRepositoryInterface;

use App\Application\DTOs\ProductDTO;
use App\Application\DTOs\ProductFilterDTO;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    private ProductRepositoryInterface $ProductRepository;

    public function __construct(ProductRepositoryInterface $ProductRepository)
    {
        $this->ProductRepository = $ProductRepository;
    }
    
  
    public function create(ProductDTO $dto): Product
    {
        return $this->ProductRepository->create($dto);
    }

    /**
     * Actualizar una categoría existente
     */
    public function update(int $id, ProductDTO $dto): Product
    {
        return $this->ProductRepository->update($id, $dto);
    }

    /**
     * Eliminar una categoría
     */
    public function delete(int $id): bool
    {
        return $this->ProductRepository->delete($id);
    }

    /**
     * Buscar categoría por ID
     */
    public function findById(int $id): ?Product
    {
        return $this->ProductRepository->findById($id);
    }

    /**
     * Obtener categorías filtradas y paginadas
     */
    public function paginate(ProductFilterDTO $filter): LengthAwarePaginator
    {
        return $this->ProductRepository->paginate(null,
            $filter->perPage
        );
    }

     public function search(ProductFilterDTO $filter): LengthAwarePaginator
    {
        return $this->ProductRepository->paginate(null,
            $filter->perPage
        );
    }

     public function list(ProductFilterDTO $filter): LengthAwarePaginator
    {
        // Llamamos al método list() del repositorio, pasando el DTO
        return $this->ProductRepository->list($filter, $filter->perPage ?? 15);
    }
}
