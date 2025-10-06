<?php

namespace App\Domain\RepositoriesInterface;

use App\Domain\Models\EmailPreference;
use App\Application\DTOs\EmailPreferenceDTO;
use App\Application\DTOs\EmailPreferenceFilterDTO;
use Illuminate\Pagination\LengthAwarePaginator;

interface EmailPreferenceRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Listar preferencias del emails con filtros específicos
     * Using union types to maintain compatibility
     */
    public function list(array|EmailPreferenceFilterDTO $filters = [], int $perPage = 15): LengthAwarePaginator;

    /**
     * Crear preferencias del email - compatible with parent interface
     */
    public function create(array|EmailPreferenceDTO $data): EmailPreference;

    /**
     * Actualizar preferencias del email - compatible with parent interface  
     */
    public function update(int|EmailPreference $id, array|EmailPreferenceDTO $data): EmailPreference;

    public function getStats(): array;

    public function canSendEmail(int $userId, string $type): array;

    public function unsubscribe(int $id): ?EmailPreference;
}