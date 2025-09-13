<?php

namespace App\Domain\RepositoriesInterface;

use App\Domain\Models\ProductVariantPriceHistory;
use App\Application\DTOs\ProductVariantPriceHistoryDTO;
use App\Application\DTOs\ProductVariantPriceHistoryFilterDTO;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductVariantPriceHistoryRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Listar registros de historial de precios con filtros específicos
     */
    public function list(array|ProductVariantPriceHistoryFilterDTO $filters = [], int $perPage = 15): LengthAwarePaginator;

    /**
     * Crear un registro del historial de precios
     */
    public function create(array|ProductVariantPriceHistoryDTO $data): ProductVariantPriceHistory;

    /**
     * Actualizar un registro del historial de precios
     * @param int|ProductVariantPriceHistory $id
     * @param array|ProductVariantPriceHistoryDTO $data
     */
    public function update(int|ProductVariantPriceHistory $id, array|ProductVariantPriceHistoryDTO $data): ProductVariantPriceHistory;

    /**
     * Obtener un registro por ID
     */
    public function findById(int $id): ?ProductVariantPriceHistory;
}