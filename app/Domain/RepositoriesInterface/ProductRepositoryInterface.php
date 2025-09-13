<?php

namespace App\Domain\RepositoriesInterface;

use App\Domain\Models\Product;
use App\Application\DTOs\ProductDTO;
use App\Application\DTOs\ProductFilterDTO;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Listar productos con filtros específicos
     */
    public function list(array|ProductFilterDTO $filters = [], int $perPage = 15): LengthAwarePaginator;


    /**
     * Crear producto con DTO específico
     */
    public function create(array|ProductDTO $dto): Product;

    /**
     * Actualizar producto con DTO específico
     */
  
    /**
     * Actualizar categoría - compatible with parent interface  
     */
    public function update(int|Product $id, array|ProductDTO $data): Product;

}