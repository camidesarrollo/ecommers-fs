<?php

namespace App\Domain\RepositoriesInterface;

use App\Domain\Models\Order;
use App\Application\DTOs\OrderDTO;
use App\Application\DTOs\OrderFilterDTO;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface OrderRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Listar categorías con filtros específicos
     * Using union types to maintain compatibility
     */
    public function list(array|OrderFilterDTO $filters = [], int $perPage = 15): LengthAwarePaginator;

    /**
     * Crear categoría - compatible with parent interface
     */
    public function create(array|OrderDTO $data): Order;

    /**
     * Actualizar categoría - compatible with parent interface  
     */
    public function update(int|Order $id, array|OrderDTO $data): Order;


}