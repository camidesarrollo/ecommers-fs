<?php

namespace App\Application\Services;

use App\Domain\Models\EmailPreference;
use App\Domain\RepositoriesInterface\EmailPreferenceRepositoryInterface;
use App\Application\DTOs\EmailPreferenceDTO;
use App\Application\DTOs\EmailPreferenceFilterDTO;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class EmailPreferenceService
{
    private EmailPreferenceRepositoryInterface $emailPreferenceRepository;

    public function __construct(EmailPreferenceRepositoryInterface $emailPreferenceRepository)
    {
        $this->emailPreferenceRepository = $emailPreferenceRepository;
    }

    /**
     * Listar preferencias de email con filtros y paginación
     */
    public function list(EmailPreferenceFilterDTO|array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->emailPreferenceRepository->list($filters, $perPage);
    }

    /**
     * Obtener una preferencia por ID
     */
    public function findById(int $id): ?EmailPreference
    {
        return $this->emailPreferenceRepository->findById($id);
    }

    /**
     * Crear una nueva preferencia de email
     */
    public function create(EmailPreferenceDTO|array $dto): EmailPreference
    {
        return $this->emailPreferenceRepository->create($dto);
    }

    /**
     * Actualizar una preferencia existente
     */
    public function update(int $id, EmailPreferenceDTO|array $dto): EmailPreference
    {
        return $this->emailPreferenceRepository->update($id, $dto);
    }

    /**
     * Eliminar (soft delete) una preferencia
     */
    public function delete(int $id): bool
    {
        return $this->emailPreferenceRepository->delete($id);
    }

    /**
     * Restaurar una preferencia eliminada
     */
    public function restore(int $id): ?EmailPreference
    {
        return $this->emailPreferenceRepository->restore($id);
    }

    /**
     * Obtener todas las preferencias
     */
    public function all(): Collection
    {
        return $this->emailPreferenceRepository->all();
    }

    /**
     * Obtener estadísticas globales de preferencias
     */
    public function getStats(): array
    {
        return $this->emailPreferenceRepository->getStats();
    }

    /**
     * Verificar si se puede enviar un tipo de correo al usuario
     */
    public function canSendEmail(int $userId, string $type): array
    {
        return $this->emailPreferenceRepository->canSendEmail($userId, $type);
    }

    /**
     * Desuscribir completamente al usuario de todos los correos
     */
    public function unsubscribe(int $id): ?EmailPreference
    {
        return $this->emailPreferenceRepository->unsubscribe($id);
    }

    /**
     * (Opcional) Re-suscribir al usuario a los correos
     */
    public function resubscribe(int $id): ?EmailPreference
    {
        $preference = $this->emailPreferenceRepository->findById($id);

        if (!$preference) {
            return null;
        }

        $data = [
            'is_unsubscribed' => false,
            'unsubscribed_at' => null,
            'marketing_emails' => true,
            'order_emails' => true,
            'newsletter' => true,
            'promotions' => true,
            'product_updates' => true,
        ];

        return $this->emailPreferenceRepository->update($id, $data);
    }

    
    /**
     * Obtener categorías filtradas y paginadas
     */
    public function paginate(EmailPreferenceFilterDTO $filter): LengthAwarePaginator
    {

        return $this->emailPreferenceRepository->paginate(null,
            $filter->perPage
        );
    }
}
