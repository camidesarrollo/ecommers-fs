<?php

namespace App\Application\Services;

use App\Domain\Models\Product;
use App\Domain\Models\ListaProducto;
use App\Application\DTOs\ProductDTO;
use App\Application\DTOs\ProductFilterDTO;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    /**
     * Listar productos con filtros y paginación
     */
    public function list(ProductFilterDTO $filter): LengthAwarePaginator
    {
        $query = ListaProducto::query();

        if ($filter->search) {
            $query->where(function ($q) use ($filter) {
                $q->where('product_name', 'like', '%' . $filter->search . '%')
                     ->orWhere('slug', 'like', '%' . $filter->search . '%')
                    ->orWhere('sku', 'like', '%' . $filter->search . '%');
            });
        }

        if ($filter->category_id) {
            $query->where('category_id', $filter->category_id);
        }

        if (!is_null($filter->isActive)) {
            $query->where('is_active', $filter->isActive);
        }

        if (!is_null($filter->isFeatured)) {
            $query->where('is_featured', $filter->isFeatured);
        }

        if ($filter->minPrice) {
            $query->where('price', '>=', $filter->minPrice);
        }

        if ($filter->maxPrice) {
            $query->where('price', '<=', $filter->maxPrice);
        }

        if ($filter->stockStatus) {
            $query->where('stock_status', $filter->stockStatus);
        }

        $query->orderBy($filter->orderBy, $filter->orderDirection);

        return $query->paginate($filter->perPage);
    }

    /**
     * Obtener un producto por su ID
     */
    public function findById(int $id): ?Product
    {
        return Product::find($id);
    }

    /**
     * Crear un nuevo producto desde ProductDTO
     */
    public function create(ProductDTO $dto): Product
    {
        return Product::create($dto->toArray());
    }

    /**
     * Actualizar un producto existente
     */
    public function update(Product $product, ProductDTO $dto): Product
    {
        $product->update($dto->toArray());
        return $product->refresh();
    }

    /**
     * Eliminar un producto (SoftDelete)
     */
    public function delete(Product $product): bool
    {
        return (bool) $product->delete();
    }

    /**
     * Restaurar un producto eliminado
     */
    public function restore(int $id): ?Product
    {
        $product = Product::withTrashed()->find($id);

        if ($product && $product->trashed()) {
            $product->restore();
            return $product;
        }

        return null;
    }

    /**
     * Obtener todos los productos destacados activos (sin paginar)
     */
    public function getFeatured(): Collection
    {
        return Product::where('is_active', true)
            ->where('is_featured', true)
            ->get();
    }

    public function search(ProductFilterDTO $filter) : LengthAwarePaginator
    {
        $query = Product::query();

        if ($filter->search) $query->where('name', 'like', "%{$filter->search}%");
        if ($filter->search) $query->where('slug', 'like', "%{$filter->search}%");
        if ($filter->category_id) $query->where('category_id', $filter->category_id);
        if ($filter->search !== null) $query->where('is_active', $filter->search);
        if ($filter->search) {
            $query->where('stock', '>', 0);
            if ($filter->search === 'out_of_stock') {
                $query->where('stock', '<=', 0);
            }
        }
        if ($filter->minPrice) $query->where('price', '>=', $filter->minPrice);
        if ($filter->maxPrice) $query->where('price', '<=', $filter->maxPrice);

        return $query->paginate($filter->perPage);
    }
}
