<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Application\Services\ProductService;
use App\Application\DTOs\ProductDTO;
use App\Application\DTOs\ProductFilterDTO;
use App\Http\Requests\Product\ProductIndexRequest;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Requests\Product\ProductSearchRequest;
use App\Http\Resources\ProductResource;
use App\Http\Controllers\Api\ApiResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService
    ) {}

    public function index(ProductIndexRequest $request): JsonResponse
    {
        $filter = ProductFilterDTO::fromArray($request->validated());
        $products = $this->productService->list($filter);
        // Usa ApiResponse paginated si quieres paginación completa
        return ApiResponse::paginated($products, 'Lista de productos obtenida');
    }

    public function show(int $id): JsonResponse
    {
        $product = $this->productService->findById($id);

        return $product
            ? ApiResponse::resource(new ProductResource($product), 'Producto encontrado')
            : ApiResponse::notFound('Producto no encontrado');
    }

    public function store(ProductStoreRequest $request): JsonResponse
    {
        $dto = ProductDTO::fromArray($request->validated());
        $product = $this->productService->create($dto);

        return ApiResponse::created(new ProductResource($product), 'Producto creado correctamente');
    }

    public function update(ProductUpdateRequest $request, int $id): JsonResponse
    {
        $product = $this->productService->findById($id);
        if (!$product) {
            return ApiResponse::notFound('Producto no encontrado');
        }

        $dto = ProductDTO::fromArray($request->validated());
        $product = $this->productService->update($product, $dto);

        return ApiResponse::success(new ProductResource($product), 'Producto actualizado correctamente');
    }

    public function destroy(int $id): JsonResponse
    {
        $product = $this->productService->findById($id);
        if (!$product) {
            return ApiResponse::notFound('Producto no encontrado');
        }

        $this->productService->delete($product);
        return ApiResponse::noContent();
    }

    public function restore(int $id): JsonResponse
    {
        $product = $this->productService->restore($id);
        return $product
            ? ApiResponse::success(new ProductResource($product), 'Producto restaurado correctamente')
            : ApiResponse::notFound('No se pudo restaurar el producto');
    }

    public function featured(): JsonResponse
    {
        $products = $this->productService->getFeatured();
        $data = ProductResource::collection($products);

        return ApiResponse::send($data);
    }

      /**
     * Buscar productos con filtros
     */
    public function search(ProductSearchRequest $request): JsonResponse
    {
     
        // Convierte los filtros validados en DTO
    
        $filter = ProductFilterDTO::fromArray($request->validated());
        // Llamada al servicio para obtener productos filtrados
        $products = $this->productService->search($filter);
        
        // Usa ApiResponse paginated si quieres paginación completa
        return ApiResponse::paginated($products, 'Productos encontrados');
    }
}
