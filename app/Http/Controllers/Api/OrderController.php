<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Application\Services\OrderService;
use App\Application\DTOs\OrderDTO;
use App\Application\DTOs\OrderFilterDTO;
use App\Http\Requests\Order\OrderIndexRequest;
use App\Http\Requests\Order\OrderStoreRequest;
use App\Http\Requests\Order\OrderUpdateRequest;
use App\Http\Resources\OrderResource;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected OrderService $orderService) {}

    /**
     * Listar órdenes con paginación
     */
    public function index(OrderIndexRequest $request): JsonResponse
    {
        try {
            $filterDTO = OrderFilterDTO::fromArray($request->validated());
            $orders = $this->orderService->paginate($filterDTO);

                  // Si el servicio retorna un paginador
            if ($orders instanceof \Illuminate\Pagination\LengthAwarePaginator) {
                return $this->paginatedResponse(
                    $orders->through(fn($history) => new OrderResource($history)),
                    'Órdenes obtenidas exitosamente'
                );
            }

            // Si retorna una colección
            return $this->collectionResponse(
                OrderResource::collection($orders),
                'Órdenes obtenidas exitosamente'
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Mostrar una orden específica
     */
    public function show(int $id): JsonResponse
    {
        try {
            $order = $this->orderService->findById($id);

            if (!$order) {
                return $this->notFoundResponse('Orden no encontrada');
            }

            return $this->resourceResponse(
                new OrderResource($order),
                'Orden obtenida exitosamente'
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Crear una nueva orden
     */
    public function store(OrderStoreRequest $request): JsonResponse
    {
        try {
            $orderDTO = OrderDTO::fromArray($request->validated());
            $order = $this->orderService->create($orderDTO);

            return $this->resourceResponse(
                new OrderResource($order),
                'Orden creada correctamente',
                201
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Actualizar una orden existente
     */
    public function update(OrderUpdateRequest $request, int $id): JsonResponse
    {
        try {
            $order = $this->orderService->findById($id);

            if (!$order) {
                return $this->notFoundResponse('Orden no encontrada');
            }

            $orderDTO = OrderDTO::fromArray($request->validated());
            $updatedOrder = $this->orderService->update($id, $orderDTO);

            return $this->resourceResponse(
                new OrderResource($updatedOrder),
                'Orden actualizada correctamente'
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Eliminar una orden
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $order = $this->orderService->findById($id);

            if (!$order) {
                return $this->notFoundResponse('Orden no encontrada');
            }

            $this->orderService->delete($id);

            return $this->successResponse(
                null,
                'Orden eliminada correctamente',
                204
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }
}
