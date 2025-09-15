<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Application\Services\ProductVariantPriceHistoryService;
use App\Application\DTOs\ProductVariantPriceHistoryDTO;
use App\Application\DTOs\ProductVariantPriceHistoryFilterDTO;
use App\Http\Requests\ProductVariantPriceHistory\ProductVariantPriceHistoryIndexRequest;
use App\Http\Requests\ProductVariantPriceHistory\ProductVariantPriceHistoryStoreRequest;
use App\Http\Requests\ProductVariantPriceHistory\ProductVariantPriceHistoryUpdateRequest;
use App\Http\Resources\ProductVariantPriceHistoryResource;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class ProductVariantPriceHistoryController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        protected ProductVariantPriceHistoryService $service
    ) {}

    /**
     * Listar historial de precios con filtros y paginación
     */
    public function index(ProductVariantPriceHistoryIndexRequest $request): JsonResponse
    {
        try {
            $filterDTO = ProductVariantPriceHistoryFilterDTO::fromArray($request->validated());
            $priceHistory = $this->service->paginate($filterDTO);

            // Si el servicio retorna un paginador
            if ($priceHistory instanceof \Illuminate\Pagination\LengthAwarePaginator) {
                return $this->paginatedResponse(
                    $priceHistory->through(fn($history) => new ProductVariantPriceHistoryResource($history)),
                    'Historial de precios obtenido exitosamente'
                );
            }

            // Si retorna una colección
            return $this->collectionResponse(
                ProductVariantPriceHistoryResource::collection($priceHistory),
                'Historial de precios obtenido exitosamente'
            );

        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Listar historial sin paginación (todos los registros filtrados)
     */
    public function list(ProductVariantPriceHistoryIndexRequest $request): JsonResponse
    {
        try {
            $filterDTO = ProductVariantPriceHistoryFilterDTO::fromArray($request->validated());
            $historial = $this->service->list($filterDTO);

            return $this->collectionResponse(
                ProductVariantPriceHistoryResource::collection($historial),
                'Lista completa del historial de precios obtenida exitosamente'
            );

        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Mostrar registro por ID
     */
    public function show(int $id): JsonResponse
    {
        try {
            $history = $this->service->findById($id);

            if (!$history) {
                return $this->notFoundResponse('Registro de historial de precios no encontrado');
            }

            return $this->resourceResponse(
                new ProductVariantPriceHistoryResource($history),
                'Registro de historial de precios obtenido exitosamente'
            );

        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Crear un nuevo registro de historial
     */
    public function store(ProductVariantPriceHistoryStoreRequest $request): JsonResponse
    {
        try {
            $dto = ProductVariantPriceHistoryDTO::fromArray($request->validated());
            $history = $this->service->create($dto);

            return $this->resourceResponse(
                new ProductVariantPriceHistoryResource($history),
                'Registro de historial de precios creado correctamente',
                201
            );

        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Actualizar un registro de historial existente
     */
    public function update(ProductVariantPriceHistoryUpdateRequest $request, int $id): JsonResponse
    {
        try {
            $history = $this->service->findById($id);
            
            if (!$history) {
                return $this->notFoundResponse('Registro de historial de precios no encontrado');
            }

            $dto = ProductVariantPriceHistoryDTO::fromArray($request->validated());
            $updatedHistory = $this->service->update($history->id, $dto);

            return $this->resourceResponse(
                new ProductVariantPriceHistoryResource($updatedHistory),
                'Registro de historial de precios actualizado correctamente'
            );

        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Eliminar un registro de historial
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $history = $this->service->findById($id);
            
            if (!$history) {
                return $this->notFoundResponse('Registro de historial de precios no encontrado');
            }

            $this->service->delete($id);
            
            return $this->successResponse(
                null,
                'Registro de historial de precios eliminado correctamente',
                204
            );

        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }
}