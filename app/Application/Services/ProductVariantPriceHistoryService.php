<?php

namespace App\Application\Services;

use App\Domain\Models\ProductVariantPriceHistory;
use App\Application\DTOs\ProductVariantPriceHistoryDTO;
use App\Application\DTOs\ProductVariantPriceHistoryFilterDTO;
use App\Domain\RepositoriesInterface\ProductVariantPriceHistoryRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductVariantPriceHistoryService
{
    private ProductVariantPriceHistoryRepositoryInterface $ProductRepository;

    public function __construct(ProductVariantPriceHistoryRepositoryInterface $ProductRepository)
    {
        $this->ProductRepository = $ProductRepository;
    }


    public function create(ProductVariantPriceHistoryDTO $dto): ProductVariantPriceHistory
    {
        return $this->ProductRepository->create($dto);
    }

    /**
     * Actualizar una categoría existente
     */
    public function update(int $id, ProductVariantPriceHistoryDTO $dto): ProductVariantPriceHistory
    {
        return $this->ProductRepository->update($id, $dto);
    }

    /**
     * Eliminar una categoría
     */
    public function delete(int $id): bool
    {
        return $this->ProductRepository->delete($id);
    }

    /**
     * Buscar categoría por ID
     */
    public function findById(int $id): ?ProductVariantPriceHistory
    {
        return $this->ProductRepository->findById($id);
    }

    /**
     * Obtener categorías filtradas y paginadas
     */
    public function paginate(ProductVariantPriceHistoryFilterDTO $filter): LengthAwarePaginator
    {
        return $this->ProductRepository->paginate(null,
            $filter->perPage
        );
    }

    // public function search(ProductVariantPriceHistoryFilterDTO $filter): LengthAwarePaginator
    // {
    //     return $this->ProductRepository->paginate(
    //         $filter->perPage
    //     );
    // }

    public function search(ProductVariantPriceHistoryFilterDTO $filter): LengthAwarePaginator
    {
        return $this->ProductRepository->list($filter, $filter->perPage ?? 15);
    }

    public function list(ProductVariantPriceHistoryFilterDTO $filter): LengthAwarePaginator
    {
        // Llamamos al método list() del repositorio, pasando el DTO
        return $this->ProductRepository->list($filter, $filter->perPage ?? 15);
    }
}
