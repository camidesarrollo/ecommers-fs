<?php

namespace App\Application\Services;

use App\Domain\Models\Order;
use App\Domain\RepositoriesInterface\OrderRepositoryInterface;
use App\Application\DTOs\OrderDTO;
use App\Application\DTOs\OrderFilterDTO;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderService
{
    private OrderRepositoryInterface $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Crear un nuevo pedido
     */
    public function create(OrderDTO $dto): Order
    {
        return $this->orderRepository->create($dto);
    }

    /**
     * Actualizar un pedido existente
     */
    public function update(int $id, OrderDTO $dto): Order
    {
        return $this->orderRepository->update($id, $dto);
    }

    /**
     * Eliminar un pedido
     */
    public function delete(int $id): bool
    {
        return $this->orderRepository->delete($id);
    }

    /**
     * Buscar pedido por ID
     */
    public function findById(int $id): ?Order
    {
        return $this->orderRepository->findById($id);
    }

    /**
     * Restaurar pedido eliminado
     */
    public function restore(int $id): ?Order
    {
        return $this->orderRepository->restore($id);
    }

    /**
     * Obtener todos los pedidos
     */
    public function all(): Collection
    {
        return $this->orderRepository->all();
    }

    /**
     * Obtener pedidos filtrados y paginados
     */
    public function list(OrderFilterDTO $filter): LengthAwarePaginator
    {
        return $this->orderRepository->list($filter, $filter->perPage ?? 15);
    }

      public function paginate(OrderFilterDTO $filter): LengthAwarePaginator
    {
        return $this->orderRepository->paginate(
            $filter->perPage
        );
    }
}
