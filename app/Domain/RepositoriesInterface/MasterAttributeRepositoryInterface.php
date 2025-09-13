<?php

namespace App\Domain\RepositoriesInterface;

use App\Domain\Models\MasterAttribute;
use App\Application\DTOs\AtrributeValueDTO;
use App\Application\DTOs\MasterAttributeFilterDTO;
use Illuminate\Pagination\LengthAwarePaginator;

interface MasterAttributeRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Listar AtrributeValueos con filtros específicos
     */
    public function list(array|MasterAttributeFilterDTO $filters = [], int $perPage = 15): LengthAwarePaginator;


    /**
     * Crear AtrributeValueo con DTO específico
     */
    public function create(array|AtrributeValueDTO $dto): MasterAttribute;

    /**
     * Actualizar AtrributeValueo con DTO específico
     */
  
    /**
     * Actualizar categoría - compatible with parent interface  
     */
    public function update(int|MasterAttribute $id, array|AtrributeValueDTO $data): MasterAttribute;

}