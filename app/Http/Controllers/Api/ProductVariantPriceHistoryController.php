<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Application\Services\ProductVariantPriceHistoryService;
use App\Application\DTOs\ProductVariantPriceHistoryDTO;
use App\Application\DTOs\ProductVariantPriceHistoryFilterDTO;
use App\Http\Requests\ProductVariantPriceHistory\ProductVariantPriceHistoryIndexRequest;
use App\Http\Requests\ProductVariantPriceHistory\ProductVariantPriceHistoryStoreRequest;
use App\Http\Resources\ProductVariantPriceHistoryResource;
use App\Http\Controllers\Api\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductVariantPriceHistoryController extends Controller
{
    public function __construct(
        protected ProductVariantPriceHistoryService $service
    ) {}

    /**
     * Listar historial de precios con filtros y paginación
     */
    public function index(ProductVariantPriceHistoryIndexRequest $request): AnonymousResourceCollection
    {
        $filterDTO = ProductVariantPriceHistoryFilterDTO::fromArray($request->validated());
        $products = $this->service->paginate($filterDTO);

        return ProductVariantPriceHistoryResource::collection($products);
    }

    public function list(ProductVariantPriceHistoryIndexRequest $request): AnonymousResourceCollection
    {
        $filterDTO = ProductVariantPriceHistoryFilterDTO::fromArray($request->validated());

        // Llamamos al service -> list() que aplica todos los filtros
        $historial = $this->service->list($filterDTO);

        return ProductVariantPriceHistoryResource::collection($historial);
    }

    /**
     * Mostrar registro por ID
     */
    public function show(int $id): JsonResponse
    {
        $history = $this->service->findById($id);

        return $history
            ? ApiResponse::resource(new ProductVariantPriceHistoryResource($history), 'Registro encontrado')
            : ApiResponse::notFound('Registro no encontrado');
    }

    /**
     * Crear un nuevo registro de historial
     */
    public function store(ProductVariantPriceHistoryStoreRequest $request): JsonResponse
    {
        $dto = ProductVariantPriceHistoryDTO::fromArray($request->validated());
        $history = $this->service->create($dto);

        return ApiResponse::created(new ProductVariantPriceHistoryResource($history), 'Registro creado correctamente');
    }

    // /**
    //  * Actualizar un registro de historial existente
    //  */
    // public function update(ProductVariantPriceHistoryUpdateRequest $request, int $id): JsonResponse
    // {
    //     $history = $this->service->findById($id);
    //     if (!$history) {
    //         return ApiResponse::notFound('Registro no encontrado');
    //     }

    //     $dto = ProductVariantPriceHistoryDTO::fromArray($request->validated());
    //     $history = $this->service->update($history, $dto);

    //     return ApiResponse::success(new ProductVariantPriceHistoryResource($history), 'Registro actualizado correctamente');
    // }

    // /**
    //  * Eliminar un registro de historial
    //  */
    // public function destroy(int $id): JsonResponse
    // {
    //     $history = $this->service->findById($id);
    //     if (!$history) {
    //         return ApiResponse::notFound('Registro no encontrado');
    //     }

    //     $this->service->delete($history);
    //     return ApiResponse::noContent();
    // }

    /**
     * Obtener historial actual por ID de variante
     */
    // public function currentByVariant(int $variantId): JsonResponse
    // {
    //     $histories = $this->service->getCurrentByVariantId($variantId);
    //     return ApiResponse::send(ProductVariantPriceHistoryResource::collection($histories));
    // }
}
