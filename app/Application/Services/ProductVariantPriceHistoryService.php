<?php

namespace App\Application\Services;

use App\Domain\Models\ProductVariantPriceHistory;
use App\Application\DTOs\ProductVariantPriceHistoryDTO;
use App\Application\DTOs\ProductVariantPriceHistoryFilterDTO;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProductVariantPriceHistoryService
{
    /**
     * Listar historial de precios con filtros y paginación
     */
    public function list(ProductVariantPriceHistoryFilterDTO $filter): LengthAwarePaginator
    {
        $query = ProductVariantPriceHistory::query()
            ->join('product_variants', 'product_variant_price_history.product_variant_id', '=', 'product_variants.id')
            ->join('lista_productos', 'product_variants.id', '=', 'lista_productos.product_variant_id') // <- aquí
            ->select([
                'product_variant_price_history.*',
                'product_variants.sku',
                'lista_productos.product_name',
                'lista_productos.slug'
            ]);

        if ($filter->id) {
            $query->where('id', $filter->id);
        }

        if ($filter->productVariantId) {
            $query->where('product_variant_id', $filter->productVariantId);
        }

        if (!is_null($filter->minPrice)) {
            $query->where('price', '>=', $filter->minPrice);
        }

        if (!is_null($filter->maxPrice)) {
            $query->where('price', '<=', $filter->maxPrice);
        }

        if (!is_null($filter->minSalePrice)) {
            $query->where('sale_price', '>=', $filter->minSalePrice);
        }

        if (!is_null($filter->maxSalePrice)) {
            $query->where('sale_price', '<=', $filter->maxSalePrice);
        }

        if ($filter->startDateFrom) {
            $query->where('start_date', '>=', $filter->startDateFrom);
        }

        if ($filter->startDateTo) {
            $query->where('start_date', '<=', $filter->startDateTo);
        }

        if ($filter->endDateFrom) {
            $query->where('end_date', '>=', $filter->endDateFrom);
        }

        if ($filter->endDateTo) {
            $query->where('end_date', '<=', $filter->endDateTo);
        }

        if ($filter->reason) {
            $query->where('reason', 'like', "%{$filter->reason}%");
        }

        $query->orderBy('start_date', 'desc');

        return $query->paginate($filter->perPage ?? 15);
    }

    /**
     * Obtener un registro de historial por ID
     */
    public function findById(int $id): ?ProductVariantPriceHistory
    {
        return ProductVariantPriceHistory::find($id);
    }

    /**
     * Crear un nuevo registro desde DTO
     */
    public function create(ProductVariantPriceHistoryDTO $dto): ProductVariantPriceHistory
    {
        return ProductVariantPriceHistory::create($dto->toArray());
    }

    /**
     * Actualizar un registro existente
     */
    public function update(ProductVariantPriceHistory $history, ProductVariantPriceHistoryDTO $dto): ProductVariantPriceHistory
    {
        $history->update($dto->toArray());
        return $history->refresh();
    }

    /**
     * Eliminar un registro del historial
     */
    public function delete(ProductVariantPriceHistory $history): bool
    {
        return (bool) $history->delete();
    }

    /**
     * Obtener todos los registros vigentes para una variante
     */
    public function getCurrentByVariantId(int $variantId): Collection
    {
        return ProductVariantPriceHistory::current()
            ->where('product_variant_id', $variantId)
            ->get();
    }
}
