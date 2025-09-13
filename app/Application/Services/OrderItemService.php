<?php

namespace App\Application\Services;

use App\Domain\Models\OrderItem;
use App\Domain\RepositoriesInterface\OrderItemRepositoryInterface;
use App\Application\DTOs\OrderItemDTO;
use App\Application\DTOs\OrderItemFilterDTO;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderItemService
{
    private OrderItemRepositoryInterface $orderItemRepository;

    public function __construct(OrderItemRepositoryInterface $orderItemRepository)
    {
        $this->orderItemRepository = $orderItemRepository;
    }

    /**
     * Crear un nuevo item de pedido
     */
    public function create(OrderItemDTO $dto): OrderItem
    {
        return $this->orderItemRepository->create($dto);
    }

    /**
     * Actualizar un item de pedido
     */
    public function update(int $id, OrderItemDTO $dto): OrderItem
    {
        return $this->orderItemRepository->update($id, $dto);
    }

    /**
     * Eliminar un item de pedido
     */
    public function delete(int $id): bool
    {
        return $this->orderItemRepository->delete($id);
    }

    /**
     * Buscar item de pedido por ID
     */
    public function findById(int $id): ?OrderItem
    {
        return $this->orderItemRepository->findById($id);
    }

    /**
     * Restaurar item de pedido eliminado
     */
    public function restore(int $id): ?OrderItem
    {
        return $this->orderItemRepository->restore($id);
    }

    /**
     * Obtener todos los items
     */
    public function all(): Collection
    {
        return $this->orderItemRepository->all();
    }

    /**
     * Obtener items filtrados y paginados
     */
    public function list(OrderItemFilterDTO $filter): LengthAwarePaginator
    {
        return $this->orderItemRepository->list($filter, $filter->perPage ?? 15);
    }

    public function paginate(OrderItemFilterDTO $filter): LengthAwarePaginator
    {
        return $this->orderItemRepository->paginate(
            $filter->perPage
        );
    }

    public function getTopProductsLastYear(int $limit = 15): Collection
    {
        return $this->orderItemRepository->getTopProductsLastYear($limit);
    }
}
