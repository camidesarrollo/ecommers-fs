<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Application\Services\ProductService;
use App\Application\Services\OrderItemService;
use App\Application\DTOs\ProductDTO;
use App\Application\DTOs\ProductFilterDTO;
use App\Http\Requests\Product\ProductIndexRequest;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Requests\Product\ProductSearchRequest;
use App\Http\Resources\ProductResource;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        protected ProductService $productService,
        protected OrderItemService $orderItemService,
    ) {}

    /**
     * Listar productos con paginación
     */
    public function index(ProductIndexRequest $request): JsonResponse
    {
        try {
            $filterDTO = ProductFilterDTO::fromArray($request->validated());
            $products = $this->productService->paginate($filterDTO);

            // Si el servicio retorna un paginador
            if ($products instanceof \Illuminate\Pagination\LengthAwarePaginator) {
                return $this->paginatedResponse(
                    $products->through(fn($product) => new ProductResource($product)),
                    'Productos obtenidos exitosamente'
                );
            }

            // Si retorna una colección
            return $this->collectionResponse(
                ProductResource::collection($products),
                'Productos obtenidos exitosamente'
            );

        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Listar todos los productos (sin paginación)
     */
    public function list(ProductIndexRequest $request): JsonResponse
    {
        try {
            $filterDTO = ProductFilterDTO::fromArray($request->validated());
            $products = $this->productService->list($filterDTO);

            return $this->collectionResponse(
                ProductResource::collection($products),
                'Lista de productos obtenida exitosamente'
            );

        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Mostrar un producto específico
     */
    public function show(int $id): JsonResponse
    {
        try {
            $product = $this->productService->findById($id);

            if (!$product) {
                return $this->notFoundResponse('Producto no encontrado');
            }

            return $this->resourceResponse(
                new ProductResource($product),
                'Producto obtenido exitosamente'
            );

        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Crear un nuevo producto
     */
    public function store(ProductStoreRequest $request): JsonResponse
    {
        try {
            $dto = ProductDTO::fromArray($request->validated());
            $product = $this->productService->create($dto);

            return $this->resourceResponse(
                new ProductResource($product),
                'Producto creado correctamente',
                201
            );

        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Obtener productos destacados (más vendidos)
     */
    public function productosDestacados(): JsonResponse
    {
        try {
            // Obtenemos los top 15 productos más vendidos del último año
            $topOrderItems = $this->orderItemService->getTopProductsLastYear(15);

            // Mapear los productVariants a los productos
            $products = $topOrderItems->map(fn($orderItem) => $orderItem->productVariant->product);

            // Remover duplicados si algún producto tiene varias variantes
            $products = $products->unique('id');

            return $this->collectionResponse(
                ProductResource::collection($products),
                'Productos destacados obtenidos exitosamente'
            );

        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Buscar productos con filtros
     */
    public function search(ProductSearchRequest $request): JsonResponse
    {
        try {
            $filterDTO = ProductFilterDTO::fromArray($request->validated());
            $products = $this->productService->search($filterDTO);

            return $this->collectionResponse(
                ProductResource::collection($products),
                'Búsqueda de productos completada exitosamente'
            );

        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Actualizar un producto existente
     */
    public function update(ProductUpdateRequest $request, int $id): JsonResponse
    {
        try {
            $product = $this->productService->findById($id);
            
            if (!$product) {
                return $this->notFoundResponse('Producto no encontrado');
            }

            $dto = ProductDTO::fromArray($request->validated());
            $updatedProduct = $this->productService->update($product->id, $dto);

            return $this->resourceResponse(
                new ProductResource($updatedProduct),
                'Producto actualizado correctamente'
            );

        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Eliminar un producto
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $product = $this->productService->findById($id);
            
            if (!$product) {
                return $this->notFoundResponse('Producto no encontrado');
            }

            $this->productService->delete($product->id);
            
            return $this->successResponse(
                null,
                'Producto eliminado correctamente',
                204
            );

        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }
}