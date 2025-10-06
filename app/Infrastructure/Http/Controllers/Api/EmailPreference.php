<?php

namespace App\Infrastructure\Http\Controllers\Api;

use App\Infrastructure\Http\Controllers\Controller;
use App\Application\Services\EmailPreferenceService;
use App\Application\DTOs\EmailPreferenceDTO;
use App\Application\DTOs\EmailPreferenceFilterDTO;
use App\Infrastructure\Http\Requests\EmailPreference\EmailPreferenceIndexRequest;
use App\Infrastructure\Http\Requests\EmailPreference\EmailPreferenceStoreRequest;
use App\Infrastructure\Http\Requests\EmailPreference\EmailPreferenceUpdateRequest;
use App\Infrastructure\Http\Resources\EmailPreferenceResource;
use App\Infrastructure\Http\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class EmailPreferenceController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected EmailPreferenceService $emailPreferenceService) {}

    /**
     * Listar preferencias de correo con paginación o colección
     */
    public function index(EmailPreferenceIndexRequest $request): JsonResponse
    {
        try {
            $filterDTO = EmailPreferenceFilterDTO::fromArray($request->validated());
            $preferences = $this->emailPreferenceService->paginate($filterDTO);

            if ($preferences instanceof \Illuminate\Pagination\LengthAwarePaginator) {
                return $this->paginatedResponse(
                    $preferences->through(fn($pref) => new EmailPreferenceResource($pref)),
                    'Preferencias de correo obtenidas exitosamente'
                );
            }

            return $this->collectionResponse(
                EmailPreferenceResource::collection($preferences),
                'Preferencias de correo obtenidas exitosamente'
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Mostrar una preferencia específica
     */
    public function show(int $id): JsonResponse
    {
        try {
            $preference = $this->emailPreferenceService->findById($id);

            if (!$preference) {
                return $this->notFoundResponse('Preferencia de correo no encontrada');
            }

            return $this->resourceResponse(
                new EmailPreferenceResource($preference),
                'Preferencia de correo obtenida exitosamente'
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Crear una nueva preferencia de correo
     */
    public function store(EmailPreferenceStoreRequest $request): JsonResponse
    {
        try {
            $preferenceDTO = EmailPreferenceDTO::fromArray($request->validated());
            $preference = $this->emailPreferenceService->create($preferenceDTO);

            return $this->resourceResponse(
                new EmailPreferenceResource($preference),
                'Preferencia de correo creada correctamente',
                201
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Actualizar una preferencia existente
     */
    public function update(EmailPreferenceUpdateRequest $request, int $id): JsonResponse
    {
        try {
            $preference = $this->emailPreferenceService->findById($id);

            if (!$preference) {
                return $this->notFoundResponse('Preferencia de correo no encontrada');
            }

            $preferenceDTO = EmailPreferenceDTO::fromArray($request->validated());
            $updatedPreference = $this->emailPreferenceService->update($id, $preferenceDTO);

            return $this->resourceResponse(
                new EmailPreferenceResource($updatedPreference),
                'Preferencia de correo actualizada correctamente'
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Eliminar una preferencia de correo
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $preference = $this->emailPreferenceService->findById($id);

            if (!$preference) {
                return $this->notFoundResponse('Preferencia de correo no encontrada');
            }

            $this->emailPreferenceService->delete($id);

            return $this->successResponse(
                null,
                'Preferencia de correo eliminada correctamente',
                204
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Desuscribir a un usuario de todos los correos (acción rápida)
     */
    public function unsubscribe(int $id): JsonResponse
    {
        try {
            $preference = $this->emailPreferenceService->unsubscribe($id);

            if (!$preference) {
                return $this->notFoundResponse('Preferencia no encontrada para desuscripción');
            }

            return $this->resourceResponse(
                new EmailPreferenceResource($preference),
                'Usuario desuscrito correctamente'
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }
}
