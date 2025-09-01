<?php
/*
namespace App\Application\Products\Services;

use App\Domain\Products\Models\Product;
use App\Domain\Products\Repositories\ProductRepositoryInterface;
use App\Application\Products\DTOs\ProductDTO;
use App\Application\Products\DTOs\ProductFilterDTO;

class ProductService
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {}
    
    public function getProducts(ProductFilterDTO $filters): array
    {
        $products = $this->productRepository->getPaginated(
            $filters->toArray(),
            $filters->perPage
        );
        
        return [
            'data' => $products->items(),
            'meta' => [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
            ]
        ];
    }
    
    public function getProductBySlug(string $slug): ?Product
    {
        return $this->productRepository->findBySlug($slug);
    }
    
    public function createProduct(ProductDTO $productDTO): Product
    {
        $data = $productDTO->toArray();
        $data['slug'] = $this->generateSlug($data['name']);
        
        return $this->productRepository->create($data);
    }
    
    public function updateProduct(int $id, ProductDTO $productDTO): ?Product
    {
        $product = $this->productRepository->findById($id);
        
        if (!$product) {
            return null;
        }
        
        return $this->productRepository->update($product, $productDTO->toArray());
    }
    
    private function generateSlug(string $name): string
    {
        return Str::slug($name);
    }
}*/