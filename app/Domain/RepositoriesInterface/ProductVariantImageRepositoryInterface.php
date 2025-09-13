<?php

namespace App\Domain\RepositoriesInterface;

use App\Domain\Models\ProductVariantImage;
use App\Application\DTOs\ProductVariantImageDTO;
use App\Application\DTOs\ProductVariantImageFilterDTO;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductVariantImageRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Listar ProductVariantImageos con filtros específicos
     */
    public function list(array|ProductVariantImageFilterDTO $filters = [], int $perPage = 15): LengthAwarePaginator;


    /**
     * Crear ProductVariantImageo con DTO específico
     */
    public function create(array|ProductVariantImageDTO $dto): ProductVariantImage;

    /**
     * Actualizar ProductVariantImageo con DTO específico
     */
  
    /**
     * Actualizar categoría - compatible with parent interface  
     */
    public function update(int|ProductVariantImage $id, array|ProductVariantImageDTO $data): ProductVariantImage;

}