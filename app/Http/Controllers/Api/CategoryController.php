<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Application\Services\CategoryService;
use App\Application\DTOs\CategoryDTO;
use App\Application\DTOs\CategoryFilterDTO;
use App\Http\Requests\Category\CategoryIndexRequest;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected CategoryService $categoryService) {}

    /**
     * Listar categorías con paginación
     */
    public function index(CategoryIndexRequest $request): JsonResponse
    {
        try {
            $filterDTO = CategoryFilterDTO::fromArray($request->validated());
            $categories = $this->categoryService->paginate($filterDTO);
            // Si el servicio retorna un paginador
            if ($categories instanceof \Illuminate\Pagination\LengthAwarePaginator) {
                return $this->paginatedResponse(
                    $categories->through(fn($history) => new CategoryResource($history)),
                    'Categorías obtenidas exitosamente'
                );
            }

            // Si retorna una colección
            return $this->collectionResponse(
                CategoryResource::collection($categories),
                'Órdenes obtenidas exitosamente'
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Mostrar una categoría específica
     */
    public function show(int $id): JsonResponse
    {
        try {
            $category = $this->categoryService->findById($id);

            if (!$category) {
                return $this->notFoundResponse('Categoría no encontrada');
            }

            return $this->resourceResponse(
                new CategoryResource($category),
                'Categoría obtenida exitosamente'
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Listar todas las categorías activas
     */
    public function allActive(): JsonResponse
    {
        try {
            $categories = $this->categoryService->allActive();

            return $this->collectionResponse(
                CategoryResource::collection($categories),
                'Categorías activas obtenidas exitosamente'
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Crear una nueva categoría
     */
    public function store(CategoryStoreRequest $request): JsonResponse
    {
        try {
            $categoryDTO = CategoryDTO::fromArray($request->validated());
            $category = $this->categoryService->create($categoryDTO);

            return $this->resourceResponse(
                new CategoryResource($category),
                'Categoría creada correctamente',
                201
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Actualizar una categoría existente
     */
    public function update(CategoryUpdateRequest $request, int $id): JsonResponse
    {
        try {
            $category = $this->categoryService->findById($id);

            if (!$category) {
                return $this->notFoundResponse('Categoría no encontrada');
            }

            $categoryDTO = CategoryDTO::fromArray($request->validated());
            $updatedCategory = $this->categoryService->update($id, $categoryDTO);

            return $this->resourceResponse(
                new CategoryResource($updatedCategory),
                'Categoría actualizada correctamente'
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Eliminar una categoría
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $category = $this->categoryService->findById($id);

            if (!$category) {
                return $this->notFoundResponse('Categoría no encontrada');
            }

            $this->categoryService->delete($id);

            return $this->successResponse(
                null,
                'Categoría eliminada correctamente',
                204
            );
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }
}
