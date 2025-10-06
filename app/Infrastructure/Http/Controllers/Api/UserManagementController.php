<?php

namespace App\Infrastructure\Http\Controllers\Api;

use App\Infrastructure\Http\Controllers\Controller;
use App\Application\Services\UserService;
use App\Application\DTOs\UserDTO;
use App\Application\DTOs\UserFilterDTO;
use App\Infrastructure\Http\Requests\User\UserIndexRequest;
use App\Infrastructure\Http\Requests\User\UserStoreRequest;
use App\Infrastructure\Http\Requests\User\UserUpdateRequest;
use App\Infrastructure\Http\Requests\User\UserLoginRequest;
use App\Infrastructure\Http\Requests\User\UserLoginGoogleRequest;
use App\Infrastructure\Http\Resources\UserResource;
use App\Infrastructure\Http\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;


class UserManagementController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected UserService $service)
    {
        $this->middleware('auth:sanctum')->except(['login', 'register']);
    }

    /**
     * Listar usuarios con paginación y filtros
     */
    public function index(UserIndexRequest $request): JsonResponse
    {
        try {
            $filterDTO = UserFilterDTO::fromArray($request->validated());
            $users = $this->service->listUsers($filterDTO);

            if ($users instanceof \Illuminate\Pagination\LengthAwarePaginator) {
                return $this->paginatedResponse(
                    $users->through(fn($user) => new UserResource($user)),
                    'Usuarios obtenidos correctamente'
                );
            }

            return $this->collectionResponse(
                UserResource::collection($users),
                'Usuarios obtenidos correctamente'
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Listar todos los usuarios filtrados (sin paginación)
     */
    public function list(UserIndexRequest $request): JsonResponse
    {
        try {
            $filterDTO = UserFilterDTO::fromArray($request->validated());
            $users = $this->service->listUsers($filterDTO, 0); // 0 = sin paginación

            return $this->collectionResponse(
                UserResource::collection($users),
                'Lista completa de usuarios obtenida correctamente'
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Mostrar usuario por ID
     */
    public function show(int $id): JsonResponse
    {
        try {
            $user = $this->service->findUserById($id);

            if (!$user) {
                return $this->notFoundResponse('Usuario no encontrado');
            }

            return $this->resourceResponse(
                new UserResource($user),
                'Usuario obtenido correctamente'
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Registrar un usuario
     */
    public function register(UserStoreRequest $request): JsonResponse
    {
        try {
            $dto = UserDTO::fromArray($request->validated());
            $user = $this->service->register($dto);

            return $this->resourceResponse(
                new UserResource($user),
                'Usuario registrado correctamente',
                201
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Login de usuario
     */
    public function login(UserLoginRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $login = $this->service->login(
                $data['email'],
                $data['password'],
                $data['device_name'] ?? null
            );

            return $this->successResponse($login, 'Login exitoso');
            return $this->resourceResponse(
                new UserResource($login),
                'Login exitoso',
                201
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    public function loginGoogle(UserLoginGoogleRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $login = $this->service->loginGoogle($data);

            return $this->successResponse($login, 'Login exitoso');
            return $this->resourceResponse(
                new UserResource($login),
                'Login exitoso',
                201
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Actualizar usuario
     */
    public function update(UserUpdateRequest $request, int $id): JsonResponse
    {
        try {
            $user = $this->service->findUserById($id);

            if (!$user) {
                return $this->notFoundResponse('Usuario no encontrado');
            }

            $dto = UserDTO::fromArray($request->validated());
            $updatedUser = $this->service->updateUser($id, $dto);

            return $this->resourceResponse(
                new UserResource($updatedUser),
                'Usuario actualizado correctamente'
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Eliminar usuario (soft delete)
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $deleted = $this->service->deleteUser($id);

            if (!$deleted) {
                return $this->notFoundResponse('Usuario no encontrado');
            }

            return $this->successResponse(
                null,
                'Usuario eliminado correctamente',
                204
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Restaurar usuario eliminado
     */
    public function restore(int $id): JsonResponse
    {
        try {
            $user = $this->service->restoreUser($id);

            if (!$user) {
                return $this->notFoundResponse('Usuario no encontrado o no eliminado');
            }

            return $this->resourceResponse(
                new UserResource($user),
                'Usuario restaurado correctamente'
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }
}
