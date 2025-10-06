<?php

namespace App\Infrastructure\Http\Controllers\Api;

use App\Infrastructure\Http\Controllers\Controller;
use App\Application\Services\OrderItemService;
use App\Application\DTOs\OrderItemDTO;
use App\Application\DTOs\OrderItemFilterDTO;
use App\Infrastructure\Http\Requests\OrderItem\OrderItemIndexRequest;
use App\Infrastructure\Http\Requests\OrderItem\OrderItemStoreRequest;
use App\Infrastructure\Http\Requests\OrderItem\OrderItemUpdateRequest;
use App\Infrastructure\Http\Resources\OrderItemResource;
use App\Infrastructure\Http\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class OrderItemController extends Controller
{
    use ApiResponseTrait;

    public function __construct(private OrderItemService $orderItemService) {}

    /**
     * Listar ítems de órdenes con paginación
     */
    public function index(OrderItemIndexRequest $request): JsonResponse
    {
        try {
            $filterDTO = new OrderItemFilterDTO($request->validated());
            $items = $this->orderItemService->paginate($filterDTO);

            if ($items instanceof \Illuminate\Pagination\LengthAwarePaginator) {
                return $this->paginatedResponse(
                    $items->through(fn($item) => new OrderItemResource($item)),
                    'Ítems de orden obtenidos exitosamente'
                );
            }

            return $this->collectionResponse(
                OrderItemResource::collection($items),
                'Ítems de orden obtenidos exitosamente'
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Mostrar un ítem de orden
     */
    public function show(int $id): JsonResponse
    {
        try {
            $item = $this->orderItemService->findById($id);

            if (!$item) {
                return $this->notFoundResponse('Ítem de orden no encontrado');
            }

            return $this->resourceResponse(
                new OrderItemResource($item),
                'Ítem de orden obtenido exitosamente'
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Crear un ítem de orden
     */
    public function store(OrderItemStoreRequest $request): JsonResponse
    {
        try {
            $itemDTO = OrderItemDTO::fromArray($request->validated());
            $item = $this->orderItemService->create($itemDTO);

            return $this->resourceResponse(
                new OrderItemResource($item),
                'Ítem de orden creado correctamente',
                201
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Actualizar un ítem de orden
     */
    public function update(OrderItemUpdateRequest $request, int $id): JsonResponse
    {
        try {
            $item = $this->orderItemService->findById($id);
            if (!$item) {
                return $this->notFoundResponse('Ítem de orden no encontrado');
            }

            $itemDTO = OrderItemDTO::fromArray($request->validated());
            $updated = $this->orderItemService->update($id, $itemDTO);

            return $this->successResponse(
                new OrderItemResource($updated),
                'Ítem de orden actualizado correctamente'
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Eliminar un ítem de orden
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $item = $this->orderItemService->findById($id);
            if (!$item) {
                return $this->notFoundResponse('Ítem de orden no encontrado');
            }

            $this->orderItemService->delete($id);

            return $this->successResponse(
                null,
                'Ítem de orden eliminado correctamente',
                204
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Productos más vendidos del último año
     */
    public function topProducts(): JsonResponse
    {
        try {
            $topProducts = $this->orderItemService->getTopProductsLastYear(15);

            return $this->collectionResponse(
                OrderItemResource::collection($topProducts),
                'Top productos del último año obtenidos exitosamente'
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }
}
