<?php

namespace App\Infrastructure\Http\Repositories;

use App\Domain\Models\Order;
use App\Domain\RepositoriesInterface\OrderRepositoryInterface;
use App\Application\DTOs\OrderDTO;
use App\Application\DTOs\OrderFilterDTO;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

class OrderRepository implements OrderRepositoryInterface
{
    public function list(array|OrderFilterDTO $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Order::query();

        $filtersArray = $filters instanceof OrderFilterDTO
            ? $filters->toArray()
            : $filters;

        $this->applyFilters($query, $filtersArray);

        return $query->paginate($perPage);
    }

    public function findById(int $id): ?Order
    {
        return Order::find($id);
    }

    public function create(array|OrderDTO $data): Order
    {
        $dataArray = $data instanceof OrderDTO
            ? $data->toArray()
            : $data;

        return Order::create($dataArray);
    }

    public function update(int|Order $id, array|OrderDTO $data): Order
    {
        $order = is_int($id) ? Order::findOrFail($id) : $id;

        $dataArray = $data instanceof OrderDTO
            ? $data->toArray()
            : $data;

        $order->update($dataArray);

        return $order->fresh();
    }

    public function delete(int $id): bool
    {
        $order = Order::findOrFail($id);
        return $order->delete();
    }

    public function restore(int $id): ?Order
    {
        $order = Order::withTrashed()->find($id);

        if ($order && $order->trashed()) {
            $order->restore();
            return $order;
        }

        return null;
    }

    public function all(): Collection
    {
        return Order::all();
    }

    public function paginate($modelo, $perPage): LengthAwarePaginator
    {
        if ($modelo instanceof Builder) {
            $query = $modelo;
        } elseif (is_string($modelo) && class_exists($modelo)) {
            $query = $modelo::query();
        } else {
            $query = Order::query();
        }

        return $query->paginate($perPage);
    }

    private function applyFilters(Builder $query, array $filters): void
    {
        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (isset($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }

        if (isset($filters['total_min'])) {
            $query->where('total', '>=', $filters['total_min']);
        }

        if (isset($filters['total_max'])) {
            $query->where('total', '<=', $filters['total_max']);
        }

        if (isset($filters['created_from'])) {
            $query->whereDate('created_at', '>=', $filters['created_from']);
        }

        if (isset($filters['created_to'])) {
            $query->whereDate('created_at', '<=', $filters['created_to']);
        }

        if (isset($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', '%' . $search . '%')
                  ->orWhere('status', 'like', '%' . $search . '%');
            });
        }

        if (!isset($filters['order_by'])) {
            $query->orderBy('created_at', 'desc');
        } else {
            $orderDirection = $filters['order_direction'] ?? 'asc';
            $query->orderBy($filters['order_by'], $orderDirection);
        }
    }
}
