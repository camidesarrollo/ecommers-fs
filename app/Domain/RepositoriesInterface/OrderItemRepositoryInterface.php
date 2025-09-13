<?php

namespace App\Domain\RepositoriesInterface;

use App\Domain\Models\OrderItem;
use App\Application\DTOs\OrderItemDTO;
use App\Application\DTOs\OrderItemFilterDTO;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface OrderItemRepositoryInterface extends BaseRepositoryInterface
{

    public function list(array|OrderItemFilterDTO $filters = [], int $perPage = 15): LengthAwarePaginator;


    public function create(array|OrderItemDTO $data): OrderItem;

    public function update(int|OrderItem $id, array|OrderItemDTO $data): OrderItem;

    public function getTopProductsLastYear(int $limit): Collection;

}