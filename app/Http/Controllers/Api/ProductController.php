<?php
/*
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Application\Products\Services\ProductService;
use App\Application\Products\DTOs\ProductFilterDTO;
use App\Http\Requests\ProductIndexRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;

class ProductController extends Controller
{
    public function __construct(
        private ProductService $productService
    ) {}
    
    public function index(ProductIndexRequest $request)
    {
        $filters = new ProductFilterDTO(
            categoryId: $request->category_id,
            search: $request->search,
            priceMin: $request->price_min,
            priceMax: $request->price_max,
            sort: $request->sort,
            perPage: $request->per_page ?? 15
        );
        
        $result = $this->productService->getProducts($filters);
        
        return response()->json([
            'data' => ProductResource::collection($result['data']),
            'meta' => $result['meta']
        ]);
    }
    
    public function show(string $slug)
    {
        $product = $this->productService->getProductBySlug($slug);
        
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        
        return new ProductResource($product);
    }
}*/