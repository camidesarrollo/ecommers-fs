<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Product;
use App\Domain\Models\ListaProducto;
use App\Domain\RepositoriesInterface\ProductRepositoryInterface;
use App\Application\DTOs\ProductDTO;
use App\Application\DTOs\ProductFilterDTO;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * Listar productos con filtros específicos
     */
    public function list(array|ProductFilterDTO $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = ListaProducto::query();

        // Convertir DTO a array si viene como DTO
        if ($filters instanceof ProductFilterDTO) {
            $filtersArray = $filters->toArray();
        } else {
            $filtersArray = $filters;
        }

        $this->applyFilters($query, $filtersArray);

        return $query->paginate($filtersArray['per_page'] ?? $perPage);
    }
    /**
     * Buscar por ID
     */
    public function findById(int $id): ?Product
    {
        return Product::with(['category', 'variants'])->find($id);
    }

    /**
     * Crear producto
     */
    public function create(array|ProductDTO $data): Product
    {
        // Si los datos vienen como DTO, convertir a array
        if ($data instanceof ProductDTO) {
            $dataArray = $data->toArray();
        } else {
            $dataArray = $data;
        }

        // Separar las variantes para crear después
        $variants = $dataArray['variants'] ?? [];
        unset($dataArray['variants']);

        // Crear el producto
        $product = Product::create($dataArray);

        // Crear las variantes si existen
        if (!empty($variants)) {
            foreach ($variants as $variantData) {
                $product->variants()->create($variantData);
            }
        }

        return $product->load(['category', 'variants']);
    }

    /**
     * Actualizar producto
     */
    public function update(int|Product $id, array|ProductDTO $data): Product
    {
        // Obtener el producto si se pasa un ID
        if (is_int($id)) {
            $product = Product::findOrFail($id);
        } else {
            $product = $id;
        }

        // Si los datos vienen como DTO, convertir a array
        if ($data instanceof ProductDTO) {
            $dataArray = $data->toArray();
        } else {
            $dataArray = $data;
        }

        // Separar las variantes para actualizar después
        $variants = $dataArray['variants'] ?? [];
        unset($dataArray['variants']);

        // Actualizar el producto
        $product->update($dataArray);

        // Actualizar las variantes si se proporcionan
        if (!empty($variants)) {
            // Eliminar variantes existentes
            $product->variants()->delete();

            // Crear nuevas variantes
            foreach ($variants as $variantData) {
                $product->variants()->create($variantData);
            }
        }

        return $product->fresh(['category', 'variants']);
    }

    /**
     * Eliminar producto (soft delete)
     */
    public function delete(int $id): bool
    {
        $product = Product::findOrFail($id);
        return $product->delete();
    }

    /**
     * Restaurar producto eliminado
     */
    public function restore(int $id): ?Product
    {
        $product = Product::withTrashed()->find($id);

        if ($product && $product->trashed()) {
            $product->restore();
            return $product->load(['category', 'variants']);
        }

        return null;
    }

    /**
     * Buscar por slug
     */
    public function findBySlug(string $slug): ?Product
    {
        return Product::with(['category', 'variants'])
            ->where('slug', $slug)
            ->first();
    }

    /**
     * Obtener productos por categoría
     */
    public function findByCategory(int $categoryId, bool $activeOnly = true): Collection
    {
        $query = Product::with(['category', 'variants'])
            ->where('category_id', $categoryId);

        if ($activeOnly) {
            $query->where('is_active', true);
        }

        return $query->get();
    }

    /**
     * Obtener productos destacados
     */
    public function getFeatured(int $limit = null): Collection
    {
        $query = Product::with(['category', 'variants'])
            ->where('is_featured', true)
            ->where('is_active', true)
            ->orderBy('created_at', 'desc');

        if ($limit) {
            $query->limit($limit);
        }

        return $query->get();
    }

    /**
     * Buscar productos por SKU
     */
    public function findBySku(string $sku): ?Product
    {
        return Product::with(['category', 'variants'])
            ->whereHas('variants', function ($query) use ($sku) {
                $query->where('sku', $sku);
            })
            ->first();
    }

    /**
     * Obtener productos con stock bajo
     */
    public function getLowStock(int $threshold = 10): Collection
    {
        return Product::with(['category', 'variants'])
            ->whereHas('variants', function ($query) use ($threshold) {
                $query->where('stock', '<=', $threshold);
            })
            ->where('is_active', true)
            ->get();
    }

    /**
     * Obtener todos los registros activos
     */
    public function all(): Collection
    {
        return Product::with(['category', 'variants'])->get();
    }

    /**
     * Obtener solo productos activos
     */
    public function allActive(): Collection
    {
        return Product::with(['category', 'variants'])
            ->where('is_active', true)
            ->orderBy('name')
            ->get();
    }
    /**
     * Paginar modelo
     */
    public function paginate($modelo, $perPage): LengthAwarePaginator
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
            $query = Product::with(['category', 'variants']);
        }

        return $query->paginate($perPage);
    }


    /**
     * Aplicar filtros desde DTO
     */
    private function applyDTOFilters(Builder $query, ProductFilterDTO $filters): void
    {
        if ($filters->search) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters->search . '%')
                    ->orWhere('slug', 'like', '%' . $filters->search . '%')
                    ->orWhere('description', 'like', '%' . $filters->search . '%')
                    ->orWhereHas('variants', function ($variantQuery) use ($filters) {
                        $variantQuery->where('sku', 'like', '%' . $filters->search . '%');
                    });
            });
        }

        if ($filters->category_id) {
            $query->where('category_id', $filters->category_id);
        }

        if ($filters->isActive !== null) {
            $query->where('is_active', $filters->isActive);
        }

        if ($filters->isFeatured !== null) {
            $query->where('is_featured', $filters->isFeatured);
        }

        if ($filters->minPrice !== null || $filters->maxPrice !== null) {
            $query->whereHas('variants', function ($variantQuery) use ($filters) {
                if ($filters->minPrice !== null) {
                    $variantQuery->where('price', '>=', $filters->minPrice);
                }
                if ($filters->maxPrice !== null) {
                    $variantQuery->where('price', '<=', $filters->maxPrice);
                }
            });
        }

        if ($filters->stockStatus) {
            $query->whereHas('variants', function ($variantQuery) use ($filters) {
                if ($filters->stockStatus === 'in_stock') {
                    $variantQuery->where('stock', '>', 0);
                } elseif ($filters->stockStatus === 'out_of_stock') {
                    $variantQuery->where('stock', '<=', 0);
                }
            });
        }

        // Ordenamiento
        $query->orderBy($filters->orderBy, $filters->orderDirection);
    }

    /**
     * Aplicar filtros desde array
     */
    private function applyFilters(Builder $query, array $filters): void
    {
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('product_name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('variants', function ($variantQuery) use ($search) {
                        $variantQuery->where('sku', 'like', "%{$search}%");
                    });
            });
        }

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (isset($filters['is_active'])) {
            $query->where('is_active', $filters['is_active']);
        }

        if (isset($filters['is_featured'])) {
            $query->where('is_featured', $filters['is_featured']);
        }

        if (isset($filters['min_price']) || isset($filters['max_price'])) {
            $query->whereHas('variants', function ($variantQuery) use ($filters) {
                if (!empty($filters['min_price'])) {
                    $variantQuery->where('price', '>=', $filters['min_price']);
                }
                if (!empty($filters['max_price'])) {
                    $variantQuery->where('price', '<=', $filters['max_price']);
                }
            });
        }

        if (!empty($filters['stock_status'])) {
            $query->whereHas('variants', function ($variantQuery) use ($filters) {
                if ($filters['stock_status'] === 'in_stock') {
                    $variantQuery->where('stock', '>', 0);
                } elseif ($filters['stock_status'] === 'out_of_stock') {
                    $variantQuery->where('stock', '<=', 0);
                }
            });
        }

        // Ordenamiento
        $orderBy = $filters['order_by'] ?? 'created_at';
        $orderDirection = $filters['order_direction'] ?? 'desc';
        $query->orderBy($orderBy, $orderDirection);
    }

    public function search(ProductFilterDTO $filters): LengthAwarePaginator
    {
        $query = Product::query();

        if ($filters->search) $query->where('name', 'like', "%{$filters->search}%");
        if ($filters->search) $query->where('slug', 'like', "%{$filters->search}%");
        // if ($filters->Product_id) $query->where('Product_id', $filters->Product_id);
        if ($filters->search !== null) $query->where('is_active', $filters->search);
        if ($filters->search) {
            $query->where('stock', '>', 0);
            if ($filters->search === 'out_of_stock') {
                $query->where('stock', '<=', 0);
            }
        }
        if ($filters->minPrice) $query->where('price', '>=', $filters->minPrice);
        if ($filters->maxPrice) $query->where('price', '<=', $filters->maxPrice);

        return $query->paginate($filters->perPage);
    }
}

  

  
    // /**
    //  * Crear un nuevo producto desde ProductDTO
    //  */
    // public function create(ProductDTO $dto): Product
    // {
    //     return Product::create($dto->toArray());
    // }

    // /**
    //  * Actualizar un producto existente
    //  */
    // public function update(Product $product, ProductDTO $dto): Product
    // {
    //     $product->update($dto->toArray());
    //     return $product->refresh();
    // }

    // /**
    //  * Eliminar un producto (SoftDelete)
    //  */
    // public function delete(Product $product): bool
    // {
    //     return (bool) $product->delete();
    // }

    // /**
    //  * Restaurar un producto eliminado
    //  */
    // public function restore(int $id): ?Product
    // {
    //     $product = Product::withTrashed()->find($id);

    //     if ($product && $product->trashed()) {
    //         $product->restore();
    //         return $product;
    //     }

    //     return null;
    // }

    // /**
    //  * Obtener todos los productos destacados activos (sin paginar)
    //  */
    // public function getFeatured(): Collection
    // {
    //     return Product::where('is_active', true)
    //         ->where('is_featured', true)
    //         ->get();
    // }
