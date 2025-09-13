<?php

namespace App\Domain\RepositoriesInterface;

use App\Domain\Models\AttributeValue;
use App\Application\DTOs\AtrributeValueDTO;
use App\Application\DTOs\AttributeValueFilterDTO;
use Illuminate\Pagination\LengthAwarePaginator;

interface AttributeValueRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Listar AtrributeValueos con filtros específicos
     */
    public function list(array|AttributeValueFilterDTO $filters = [], int $perPage = 15): LengthAwarePaginator;


    /**
     * Crear AtrributeValueo con DTO específico
     */
    public function create(array|AtrributeValueDTO $dto): AttributeValue;

    /**
     * Actualizar AtrributeValueo con DTO específico
     */
  
    /**
     * Actualizar categoría - compatible with parent interface  
     */
    public function update(int|AttributeValue $id, array|AtrributeValueDTO $data): AttributeValue;

}