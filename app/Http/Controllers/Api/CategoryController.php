<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Application\Category\Services\CategoryService;
use App\Application\DTOs\CategoryDTO;
use App\Application\DTOs\CategoryFilterDTO;
use App\Http\Requests\Category\CategoryIndexRequest;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Listar categorías con paginación
     */
    public function index(CategoryIndexRequest $request): AnonymousResourceCollection
    {
        $filterDTO = new CategoryFilterDTO($request->validated());
        $categories = $this->categoryService->paginate($filterDTO);

        return CategoryResource::collection($categories);
    }

    /**
     * Mostrar una categoría
     */
    public function show(int $id): JsonResponse|CategoryResource
    {
        $category = $this->categoryService->findById($id);

        if (!$category) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }

        return new CategoryResource($category);
    }

    /**
     * Listar todas las categorías activas
     */
    public function allActive(): AnonymousResourceCollection
    {
        $categories = $this->categoryService->allActive();
        return CategoryResource::collection($categories);
    }

    /**
     * Crear una categoría
     */
    public function store(CategoryStoreRequest $request): CategoryResource
    {
        $categoryDTO = CategoryDTO::fromArray($request->validated());
        $category = $this->categoryService->create($categoryDTO);

        return new CategoryResource($category);
    }

    /**
     * Actualizar una categoría
     */
    public function update(CategoryUpdateRequest $request, int $id): JsonResponse
    {
        $categoryDTO = CategoryDTO::fromArray($request->validated());
        $updated = $this->categoryService->update($id, $categoryDTO);

        if (!$updated) {
            return response()->json(['message' => 'No se pudo actualizar la categoría'], 400);
        }

        return response()->json(['message' => 'Categoría actualizada correctamente']);
    }

    /**
     * Eliminar una categoría
     */
    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->categoryService->delete($id);

        if (!$deleted) {
            return response()->json(['message' => 'No se pudo eliminar la categoría'], 400);
        }

        return response()->json(['message' => 'Categoría eliminada correctamente']);
    }
}
