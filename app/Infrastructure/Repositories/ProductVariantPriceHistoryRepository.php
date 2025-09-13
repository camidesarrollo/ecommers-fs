<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\ProductVariantPriceHistory;
use App\Domain\RepositoriesInterface\ProductVariantPriceHistoryRepositoryInterface;
use App\Application\DTOs\ProductVariantPriceHistoryDTO;
use App\Application\DTOs\ProductVariantPriceHistoryFilterDTO;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

class ProductVariantPriceHistoryRepository implements ProductVariantPriceHistoryRepositoryInterface
{

    //  * Listar historial de precios con filtros y paginación
    //  */
    public function list(array|ProductVariantPriceHistoryFilterDTO $filter = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = ProductVariantPriceHistory::query()
            ->join('product_variants', 'product_variant_price_history.product_variant_id', '=', 'product_variants.id')
            ->join('lista_productos', 'product_variants.id', '=', 'lista_productos.product_variant_id') 
            ->select([
                'product_variant_price_history.*',
                'product_variants.sku',
                'lista_productos.imagen',
                'lista_productos.typeProduct',
                'lista_productos.variant',
                'lista_productos.name',
                'lista_productos.slug'
            ]);

        // CORRECCIÓN: usar el DTO de filtro correcto
        if ($filter instanceof ProductVariantPriceHistoryFilterDTO) {
            $filters = $filter->toArray();
        } else {
            $filters = $filter;
        }

        // Aplicación de filtros dinámicos
        if (!empty($filters['id'])) {
            $query->where('product_variant_price_history.id', $filters['id']);
        }

        if (!empty($filters['productVariantId'])) {
            $query->where('product_variant_price_history.product_variant_id', $filters['productVariantId']);
        }

        if (!empty($filters['minPrice'])) {
            $query->where('product_variant_price_history.price', '>=', $filters['minPrice']);
        }

        if (!empty($filters['maxPrice'])) {
            $query->where('product_variant_price_history.price', '<=', $filters['maxPrice']);
        }

        if (!empty($filters['minSalePrice'])) {
            $query->where('product_variant_price_history.sale_price', '>=', $filters['minSalePrice']);
        }

        if (!empty($filters['maxSalePrice'])) {
            $query->where('product_variant_price_history.sale_price', '<=', $filters['maxSalePrice']);
        }

        if (!empty($filters['startDateFrom'])) {
            $query->where('product_variant_price_history.start_date', '>=', $filters['startDateFrom']);
        }

        if (!empty($filters['startDateTo'])) {
            $query->where('product_variant_price_history.start_date', '<=', $filters['startDateTo']);
        }

        if (!empty($filters['endDateFrom'])) {
            $query->where('product_variant_price_history.end_date', '>=', $filters['endDateFrom']);
        }

        if (!empty($filters['endDateTo'])) {
            $query->where('product_variant_price_history.end_date', '<=', $filters['endDateTo']);
        }

        if (!empty($filters['reason'])) {
            $query->where('product_variant_price_history.reason', 'like', "%{$filters['reason']}%");
        }

        // Ordenamiento configurable
        $orderBy = $filters['order_by'] ?? 'product_variant_price_history.start_date';
        $orderDirection = $filters['order_direction'] ?? 'desc';
        $query->orderBy($orderBy, $orderDirection);

        return $query->paginate($filters['perPage'] ?? $perPage);
    }

    public function findById(int $id): ?ProductVariantPriceHistory
    {
        return ProductVariantPriceHistory::find($id);
    }

    public function create(array|ProductVariantPriceHistoryDTO $data): ProductVariantPriceHistory
    {
        $arrayData = $data instanceof ProductVariantPriceHistoryDTO ? $data->toArray() : $data;
        return ProductVariantPriceHistory::create($arrayData);
    }

    public function update(int|ProductVariantPriceHistory $id, array|ProductVariantPriceHistoryDTO $data): ProductVariantPriceHistory
    {
        $history = $id instanceof ProductVariantPriceHistory ? $id : ProductVariantPriceHistory::findOrFail($id);
        $arrayData = $data instanceof ProductVariantPriceHistoryDTO ? $data->toArray() : $data;

        $history->update($arrayData);
        return $history->refresh();
    }

    public function delete(int $id): bool
    {
        $history = ProductVariantPriceHistory::findOrFail($id);
        return (bool) $history->delete();
    }

    /**
     * Restaurar un registro eliminado
     */
    public function restore(int $id): ?ProductVariantPriceHistory
    {
        $history = ProductVariantPriceHistory::withTrashed()->find($id);

        if ($history && $history->trashed()) {
            $history->restore();
            return $history;
        }

        return null;
    }

    /**
     * Obtener todos los registros activos
     */
    public function all(): Collection
    {
        return ProductVariantPriceHistory::all();
    }

    /**
     * Paginación genérica
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
            $query = ProductVariantPriceHistory::query();
        }

        return $query->paginate(15);
    }

    /**
     * Aplicar filtros desde DTO
     */
    private function applyDTOFilters(Builder $query, ProductVariantPriceHistoryFilterDTO $filters): void
    {
        if ($filters->id) {
            $query->where('product_variant_price_history.id', $filters->id);
        }

        if ($filters->productVariantId) {
            $query->where('product_variant_price_history.product_variant_id', $filters->productVariantId);
        }

        if (!is_null($filters->minPrice)) {
            $query->where('product_variant_price_history.price', '>=', $filters->minPrice);
        }

        if (!is_null($filters->maxPrice)) {
            $query->where('product_variant_price_history.price', '<=', $filters->maxPrice);
        }

        if (!is_null($filters->minSalePrice)) {
            $query->where('product_variant_price_history.sale_price', '>=', $filters->minSalePrice);
        }

        if (!is_null($filters->maxSalePrice)) {
            $query->where('product_variant_price_history.sale_price', '<=', $filters->maxSalePrice);
        }

        if ($filters->startDateFrom) {
            $query->where('product_variant_price_history.start_date', '>=', $filters->startDateFrom);
        }

        if ($filters->startDateTo) {
            $query->where('product_variant_price_history.start_date', '<=', $filters->startDateTo);
        }

        if ($filters->endDateFrom) {
            $query->where('product_variant_price_history.end_date', '>=', $filters->endDateFrom);
        }

        if ($filters->endDateTo) {
            $query->where('product_variant_price_history.end_date', '<=', $filters->endDateTo);
        }

        if ($filters->reason) {
            $query->where('product_variant_price_history.reason', 'like', "%{$filters->reason}%");
        }
    }

    /**
     * Aplicar filtros desde array
     */
    private function applyFilters(Builder $query, array $filters): void
    {
        if (isset($filters['id'])) {
            $query->where('product_variant_price_history.id', $filters['id']);
        }

        if (isset($filters['product_variant_id'])) {
            $query->where('product_variant_price_history.product_variant_id', $filters['product_variant_id']);
        }

        if (isset($filters['min_price'])) {
            $query->where('product_variant_price_history.price', '>=', $filters['min_price']);
        }

        if (isset($filters['max_price'])) {
            $query->where('product_variant_price_history.price', '<=', $filters['max_price']);
        }

        if (isset($filters['min_sale_price'])) {
            $query->where('product_variant_price_history.sale_price', '>=', $filters['min_sale_price']);
        }

        if (isset($filters['max_sale_price'])) {
            $query->where('product_variant_price_history.sale_price', '<=', $filters['max_sale_price']);
        }

        if (isset($filters['start_date_from'])) {
            $query->where('product_variant_price_history.start_date', '>=', $filters['start_date_from']);
        }

        if (isset($filters['start_date_to'])) {
            $query->where('product_variant_price_history.start_date', '<=', $filters['start_date_to']);
        }

        if (isset($filters['end_date_from'])) {
            $query->where('product_variant_price_history.end_date', '>=', $filters['end_date_from']);
        }

        if (isset($filters['end_date_to'])) {
            $query->where('product_variant_price_history.end_date', '<=', $filters['end_date_to']);
        }

        if (isset($filters['reason'])) {
            $query->where('product_variant_price_history.reason', 'like', "%{$filters['reason']}%");
        }
    }
}
