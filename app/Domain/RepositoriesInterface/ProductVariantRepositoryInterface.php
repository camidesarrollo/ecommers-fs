<?php

namespace App\Domain\RepositoriesInterface;

use App\Domain\Models\ProductVariant;
use App\Application\DTOs\ProductVariantDTO;
use App\Application\DTOs\ProductVariantFilterDTO;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductVariantRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Listar ProductVariantos con filtros específicos
     */
    public function list(array|ProductVariantFilterDTO $filters = [], int $perPage = 15): LengthAwarePaginator;


    /**
     * Crear ProductVarianto con DTO específico
     */
    public function create(array|ProductVariantDTO $dto): ProductVariant;

    /**
     * Actualizar ProductVarianto con DTO específico
     */
  
    /**
     * Actualizar categoría - compatible with parent interface  
     */
    public function update(int|ProductVariant $id, array|ProductVariantDTO $data): ProductVariant;

}