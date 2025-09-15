<?php

namespace App\Infrastructure\Repository;

use App\Domain\RepositoriesInterface\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function list(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = $this->model->query();

        foreach ($filters as $key => $value) {
            $query->when($value !== null, fn($q) => $q->where($key, $value));
        }

        return $query->paginate($perPage);
    }

    public function findById(int $id): ?object
    {
        return $this->model->find($id);
    }

    public function create(array $data): object
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): object
    {
        $model = $this->findById($id);
        $model->update($data);
        return $model;
    }

    public function delete(int $id): bool
    {
        return $this->findById($id)?->delete() ?? false;
    }

    public function restore(int $id): ?object
    {
        $model = $this->model->withTrashed()->find($id);
        $model?->restore();
        return $model;
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * Paginar modelo
     */
    public function paginate($modelo, $perPage): LengthAwarePaginator
    {
        // Si es un Query Builder
        if ($modelo instanceof \Illuminate\Database\Eloquent\Builder) {
            $query = $modelo;
        }
        // Si es un string que representa un modelo
        elseif (is_string($modelo) && class_exists($modelo)) {
            $query = $modelo::query();
        }

        return $query->paginate($perPage);
    }
}
