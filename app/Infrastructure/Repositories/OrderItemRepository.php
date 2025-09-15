<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\OrderItem;
use App\Domain\RepositoriesInterface\OrderItemRepositoryInterface;
use App\Application\DTOs\OrderItemDTO;
use App\Application\DTOs\OrderItemFilterDTO;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class OrderItemRepository implements OrderItemRepositoryInterface
{
    public function list(array|OrderItemFilterDTO $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = OrderItem::query();

        $filtersArray = $filters instanceof OrderItemFilterDTO
            ? $filters->toArray()
            : $filters;

        $this->applyFilters($query, $filtersArray);

        return $query->paginate($perPage);
    }

    public function findById(int $id): ?OrderItem
    {
        return OrderItem::find($id);
    }

    public function create(array|OrderItemDTO $data): OrderItem
    {
        $dataArray = $data instanceof OrderItemDTO
            ? $data->toArray()
            : $data;

        return OrderItem::create($dataArray);
    }

    public function update(int|OrderItem $id, array|OrderItemDTO $data): OrderItem
    {
        $orderItem = is_int($id) ? OrderItem::findOrFail($id) : $id;

        $dataArray = $data instanceof OrderItemDTO
            ? $data->toArray()
            : $data;

        $orderItem->update($dataArray);

        return $orderItem->fresh();
    }

    public function delete(int $id): bool
    {
        $orderItem = OrderItem::findOrFail($id);
        return $orderItem->delete();
    }

    public function restore(int $id): ?OrderItem
    {
        $orderItem = OrderItem::withTrashed()->find($id);

        if ($orderItem && $orderItem->trashed()) {
            $orderItem->restore();
            return $orderItem;
        }

        return null;
    }

    public function all(): Collection
    {
        return OrderItem::all();
    }

    public function paginate($modelo, $perPage): LengthAwarePaginator
    {
        if ($modelo instanceof Builder) {
            $query = $modelo;
        } elseif (is_string($modelo) && class_exists($modelo)) {
            $query = $modelo::query();
        } else {
            $query = OrderItem::query();
        }

        return $query->paginate($perPage);
    }

    private function applyFilters(Builder $query, array $filters): void
    {
        if (isset($filters['order_id'])) {
            $query->where('order_id', $filters['order_id']);
        }

        if (isset($filters['product_id'])) {
            $query->where('product_id', $filters['product_id']);
        }

        if (isset($filters['quantity_min'])) {
            $query->where('quantity', '>=', $filters['quantity_min']);
        }

        if (isset($filters['quantity_max'])) {
            $query->where('quantity', '<=', $filters['quantity_max']);
        }

        if (isset($filters['price_min'])) {
            $query->where('price', '>=', $filters['price_min']);
        }

        if (isset($filters['price_max'])) {
            $query->where('price', '<=', $filters['price_max']);
        }

        if (!isset($filters['order_by'])) {
            $query->orderBy('id', 'desc');
        } else {
            $orderDirection = $filters['order_direction'] ?? 'asc';
            $query->orderBy($filters['order_by'], $orderDirection);
        }
    }

    public function getTopProductsLastYear(int $limit = 15): Collection
    {
        $lastYear = Carbon::now()->subYear();

        return OrderItem::select('product_variant_id')
            ->selectRaw('SUM(quantity) as total_quantity')
            ->whereHas('order', function ($query) use ($lastYear) {
                $query->where('created_at', '>=', $lastYear);
            })
            ->groupBy('product_variant_id')
            ->orderByDesc('total_quantity')
            ->limit($limit)
            ->with('productVariant.product') // Trae datos del producto
            ->get();
    }
}
