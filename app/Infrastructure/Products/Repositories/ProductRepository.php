<?php
/*
namespace App\Infrastructure\Products\Repositories;

use App\Domain\Products\Models\Product;
use App\Domain\Products\Repositories\ProductRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    public function findById(int $id): ?Product
    {
        return Product::with('category')->find($id);
    }
    
    public function findBySlug(string $slug): ?Product
    {
        return Product::with('category')->where('slug', $slug)->first();
    }
    
    public function getPaginated(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Product::with('category')->where('is_active', true);
        
        if (isset($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }
        
        if (isset($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', "%{$filters['search']}%")
                  ->orWhere('description', 'like', "%{$filters['search']}%");
            });
        }
        
        if (isset($filters['price_min'])) {
            $query->where('price', '>=', $filters['price_min']);
        }
        
        if (isset($filters['price_max'])) {
            $query->where('price', '<=', $filters['price_max']);
        }
        
        if (isset($filters['sort'])) {
            switch ($filters['sort']) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'name':
                    $query->orderBy('name', 'asc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }
        
        return $query->paginate($perPage);
    }
    
    public function getFeatured(int $limit = 10): Collection
    {
        return Product::with('category')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->limit($limit)
            ->get();
    }
    
    public function create(array $data): Product
    {
        return Product::create($data);
    }
    
    public function update(Product $product, array $data): Product
    {
        $product->update($data);
        return $product->fresh();
    }
    
    public function delete(Product $product): bool
    {
        return $product->delete();
    }
}*/