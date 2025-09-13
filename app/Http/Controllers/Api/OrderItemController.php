<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Application\Services\OrderItemService;
use App\Application\DTOs\OrderItemDTO;
use App\Application\DTOs\OrderItemFilterDTO;
use App\Http\Requests\OrderItem\OrderItemIndexRequest;
use App\Http\Requests\OrderItem\OrderItemStoreRequest;
use App\Http\Requests\OrderItem\OrderItemUpdateRequest;
use App\Http\Resources\OrderItemResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;

class OrderItemController extends Controller
{
    private OrderItemService $orderItemService;

    public function __construct(OrderItemService $orderItemService)
    {
        $this->orderItemService = $orderItemService;
    }

    /**
     * Listar ítems de órdenes con paginación
     */
    public function index(OrderItemIndexRequest $request): AnonymousResourceCollection
    {
        $filterDTO = new OrderItemFilterDTO($request->validated());
        $items = $this->orderItemService->paginate($filterDTO);

        return OrderItemResource::collection($items);
    }

    /**
     * Mostrar un ítem de orden
     */
    public function show(int $id): JsonResponse|OrderItemResource
    {
        $item = $this->orderItemService->findById($id);

        if (!$item) {
            return response()->json(['message' => 'Ítem de orden no encontrado'], 404);
        }

        return new OrderItemResource($item);
    }

    /**
     * Crear un ítem de orden
     */
    public function store(OrderItemStoreRequest $request): OrderItemResource
    {
        $itemDTO = OrderItemDTO::fromArray($request->validated());
        $item = $this->orderItemService->create($itemDTO);

        return new OrderItemResource($item);
    }

    /**
     * Actualizar un ítem de orden
     */
    public function update(OrderItemUpdateRequest $request, int $id): JsonResponse
    {
        $itemDTO = OrderItemDTO::fromArray($request->validated());
        $updated = $this->orderItemService->update($id, $itemDTO);

        if (!$updated) {
            return response()->json(['message' => 'No se pudo actualizar el ítem de la orden'], 400);
        }

        return response()->json(['message' => 'Ítem de orden actualizado correctamente']);
    }

    /**
     * Eliminar un ítem de orden
     */
    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->orderItemService->delete($id);

        if (!$deleted) {
            return response()->json(['message' => 'No se pudo eliminar el ítem de la orden'], 400);
        }

        return response()->json(['message' => 'Ítem de orden eliminado correctamente']);
    }

    public function topProducts(): JsonResponse
    {
        $topProducts = $this->orderItemService->getTopProductsLastYear(15);

        return response()->json([
            'data' => $topProducts
        ]);
    }
}
