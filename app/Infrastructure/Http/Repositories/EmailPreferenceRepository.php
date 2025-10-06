<?php

namespace App\Infrastructure\Http\Repositories;

use App\Domain\Models\EmailPreference;
use App\Domain\RepositoriesInterface\EmailPreferenceRepositoryInterface;
use App\Application\DTOs\EmailPreferenceDTO;
use App\Application\DTOs\EmailPreferenceFilterDTO;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

class EmailPreferenceRepository implements EmailPreferenceRepositoryInterface
{
    /**
     * Listar preferencias emails con filtros específicos
     */
    public function list(array|EmailPreferenceFilterDTO $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = EmailPreference::query();

        // Si los filtros vienen como DTO, convertir a array
        if ($filters instanceof EmailPreferenceFilterDTO) {
            $filtersArray = $filters->toArray();
        } else {
            $filtersArray = $filters;
        }

        $this->applyFilters($query, $filtersArray);

        // CORREGIDO: Llamar paginate directamente en el query, no pasarlo como parámetro
        return $query->paginate($perPage);
    }

    /**
     * Buscar por ID
     */
    public function findById(int $id): ?EmailPreference
    {
        return EmailPreference::find($id);
    }

    /**
     * Crear preferencias email
     */
    public function create(array|EmailPreferenceDTO $data): EmailPreference
    {
        // Si los datos vienen como DTO, convertir a array
        if ($data instanceof EmailPreferenceDTO) {
            $dataArray = $data->toArray();
        } else {
            $dataArray = $data;
        }

        return EmailPreference::create($dataArray);
    }

    /**
     * Actualizar preferencias email
     */
    public function update(int|EmailPreference $id, array|EmailPreferenceDTO $data): EmailPreference
    {
        // Obtener la preferencias email si se pasa un ID
        if (is_int($id)) {
            $category = EmailPreference::findOrFail($id);
        } else {
            $category = $id;
        }

        // Si los datos vienen como DTO, convertir a array
        if ($data instanceof EmailPreferenceDTO) {
            $dataArray = $data->toArray();
        } else {
            $dataArray = $data;
        }

        $category->update($dataArray);

        return $category->fresh();
    }

    /**
     * Eliminar preferencias email (soft delete)
     */
    public function delete(int $id): bool
    {
        $category = EmailPreference::findOrFail($id);
        return $category->delete();
    }

    /**
     * Restaurar preferencias email eliminada
     */
    public function restore(int $id): ?EmailPreference
    {
        $category = EmailPreference::withTrashed()->find($id);

        if ($category && $category->trashed()) {
            $category->restore();
            return $category;
        }

        return null;
    }


    /**
     * Obtener todos los registros activos
     */
    public function all(): Collection
    {
        return EmailPreference::all();
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
        // Por defecto usamos EmailPreference::query()
        else {
            $query = EmailPreference::query();
        }

        return $query->paginate($perPage);
    }

        /**
     * Obtener estadísticas de suscripciones
     */
    public function getStats(): array
    {
        $total = EmailPreference::count();
        $unsubscribed = EmailPreference::where('is_unsubscribed', true)->count();
        $marketingEnabled = EmailPreference::where('marketing_emails', true)->count();
        $newsletterEnabled = EmailPreference::where('newsletter', true)->count();
        $promotionsEnabled = EmailPreference::where('promotions', true)->count();

        $data  = [
            'total_users' => $total,
            'unsubscribed' => $unsubscribed,
            'subscribed' => $total - $unsubscribed,
            'marketing_enabled' => $marketingEnabled,
            'newsletter_enabled' => $newsletterEnabled,
            'promotions_enabled' => $promotionsEnabled,
            'subscription_rate' => $total > 0 ? round((($total - $unsubscribed) / $total) * 100, 2) : 0,
        ];

        return $data;
    }

    public function canSendEmail(int $userId, string $type): array
    {
        $preference = EmailPreference::where('user_id', $userId)->first();

        if (!$preference) {
            return [
                'success' => true,
                'can_send' => true, // Si no tiene preferencias, se asume que acepta
            ];
        }

        if ($preference->is_unsubscribed) {
            return [
                'success' => true,
                'can_send' => false,
                'reason' => 'Usuario desuscrito',
            ];
        }

        $canSend = match ($type) {
            'marketing' => $preference->marketing_emails,
            'order' => $preference->order_emails,
            'newsletter' => $preference->newsletter,
            'promotion' => $preference->promotions,
            'product' => $preference->product_updates,
            default => false,
        };

        return $canSend;
    }

   public function unsubscribe(int $id): ?EmailPreference
    {
        $preference = EmailPreference::find($id);

        if (!$preference) {
            return null;
        }

        $preference->update([
            'is_unsubscribed' => true,
            'unsubscribed_at' => now(),
            'marketing_emails' => false,
            'order_emails' => false,
            'newsletter' => false,
            'promotions' => false,
            'product_updates' => false,
        ]);

        return $preference->fresh();
    }
    /**
     * Aplicar filtros a la consulta de EmailPreference
     */
    private function applyFilters(Builder $query, array $filters): void
    {
        if (!empty($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }

        if (isset($filters['is_unsubscribed'])) {
            $query->where('is_unsubscribed', (bool) $filters['is_unsubscribed']);
        }

        if (isset($filters['marketing_emails'])) {
            $query->where('marketing_emails', (bool) $filters['marketing_emails']);
        }

        if (isset($filters['order_emails'])) {
            $query->where('order_emails', (bool) $filters['order_emails']);
        }

        if (isset($filters['newsletter'])) {
            $query->where('newsletter', (bool) $filters['newsletter']);
        }

        if (isset($filters['promotions'])) {
            $query->where('promotions', (bool) $filters['promotions']);
        }

        if (isset($filters['product_updates'])) {
            $query->where('product_updates', (bool) $filters['product_updates']);
        }

        // Filtrar por rango de fecha de desuscripción
        if (!empty($filters['unsubscribed_from'])) {
            $query->whereDate('unsubscribed_at', '>=', $filters['unsubscribed_from']);
        }

        if (!empty($filters['unsubscribed_to'])) {
            $query->whereDate('unsubscribed_at', '<=', $filters['unsubscribed_to']);
        }

        // Buscar por correo o nombre de usuario (si se carga relación)
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Ordenar resultados
        if (!empty($filters['sort_by'])) {
            $direction = $filters['sort_direction'] ?? 'asc';
            $query->orderBy($filters['sort_by'], $direction);
        } else {
            $query->latest(); // Por defecto ordenar por fecha de creación descendente
        }
    }



}
