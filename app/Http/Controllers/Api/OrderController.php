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
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Listar órdenes con paginación
     */
    public function index(OrderIndexRequest $request): AnonymousResourceCollection
    {
        $filterDTO = new OrderFilterDTO($request->validated());
        $orders = $this->orderService->paginate($filterDTO);

        return OrderResource::collection($orders);
    }

    /**
     * Mostrar una orden
     */
    public function show(int $id): JsonResponse|OrderResource
    {
        $order = $this->orderService->findById($id);

        if (!$order) {
            return response()->json(['message' => 'Orden no encontrada'], 404);
        }

        return new OrderResource($order);
    }

    /**
     * Crear una orden
     */
    public function store(OrderStoreRequest $request): OrderResource
    {
        $orderDTO = OrderDTO::fromArray($request->validated());
        $order = $this->orderService->create($orderDTO);

        return new OrderResource($order);
    }

    /**
     * Actualizar una orden
     */
    public function update(OrderUpdateRequest $request, int $id): JsonResponse
    {
        $orderDTO = OrderDTO::fromArray($request->validated());
        $updated = $this->orderService->update($id, $orderDTO);

        if (!$updated) {
            return response()->json(['message' => 'No se pudo actualizar la orden'], 400);
        }

        return response()->json(['message' => 'Orden actualizada correctamente']);
    }

    /**
     * Eliminar una orden
     */
    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->orderService->delete($id);

        if (!$deleted) {
            return response()->json(['message' => 'No se pudo eliminar la orden'], 400);
        }

        return response()->json(['message' => 'Orden eliminada correctamente']);
    }
}
