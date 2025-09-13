<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response;

class ApiResponse
{
    /**
     * Respuesta JSON estándar
     *
     * @param mixed $data      Datos de la respuesta
     * @param array|null $meta Información adicional (paginación, etc.)
     * @param int $status      Código HTTP
     * @param array $headers   Headers adicionales
     */
    public static function send(
        mixed $data = null,
        ?array $meta = null,
        int $status = Response::HTTP_OK,
        array $headers = []
    ): JsonResponse {
        $response = [
            'success' => $status >= 200 && $status < 300,
            'data' => $data,
            'timestamp' => now()->toISOString(),
        ];

        if ($meta) {
            $response['meta'] = $meta;
        }

        return response()->json($response, $status, $headers);
    }

    /**
     * Respuesta de éxito
     */
    public static function success(
        mixed $data = null,
        string $message = 'Operation completed successfully',
        ?array $meta = null
    ): JsonResponse {
        return self::send($data, array_merge($meta ?? [], ['message' => $message]), Response::HTTP_OK);
    }

    /**
     * Respuesta de recurso creado
     */
    public static function created(
        mixed $data = null,
        string $message = 'Resource created successfully'
    ): JsonResponse {
        return self::send($data, ['message' => $message], Response::HTTP_CREATED);
    }

    /**
     * Respuesta sin contenido
     */
    public static function noContent(): JsonResponse
    {
        return self::send(null, null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Respuesta de error
     *
     * @param string|array $message Mensaje de error
     * @param int $status Código HTTP
     * @param array|null $errors Errores detallados (validación, etc.)
     * @param array $headers Headers adicionales
     */
    public static function error(
        string|array $message,
        int $status = Response::HTTP_BAD_REQUEST,
        ?array $errors = null,
        array $headers = []
    ): JsonResponse {
        $response = [
            'success' => false,
            'message' => $message,
            'timestamp' => now()->toISOString(),
        ];

        if ($errors) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $status, $headers);
    }

    /**
     * Respuesta de error de validación
     */
    public static function validationError(
        array $errors,
        string $message = 'Validation failed'
    ): JsonResponse {
        return self::error($message, Response::HTTP_UNPROCESSABLE_ENTITY, $errors);
    }

    /**
     * Respuesta de recurso no encontrado
     */
    public static function notFound(string $message = 'Resource not found'): JsonResponse
    {
        return self::error($message, Response::HTTP_NOT_FOUND);
    }

    /**
     * Respuesta de no autorizado
     */
    public static function unauthorized(string $message = 'Unauthorized'): JsonResponse
    {
        return self::error($message, Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Respuesta de acceso prohibido
     */
    public static function forbidden(string $message = 'Access forbidden'): JsonResponse
    {
        return self::error($message, Response::HTTP_FORBIDDEN);
    }

    /**
     * Respuesta de error interno del servidor
     */
    public static function serverError(string $message = 'Internal server error'): JsonResponse
    {
        return self::error($message, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Respuesta con paginación
     */
    public static function paginated(
        LengthAwarePaginator $paginator,
        string $message = null
    ): JsonResponse {
        $meta = [
            'pagination' => [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'from' => $paginator->firstItem(),
                'to' => $paginator->lastItem(),
                'has_more_pages' => $paginator->hasMorePages(),
            ],
        ];

        if ($message) {
            $meta['message'] = $message;
        }

        return self::send($paginator->items(), $meta);
    }

    /**
     * Respuesta con colección
     */
    public static function collection(
        Collection|array $collection,
        string $message = null,
        ?array $additionalMeta = null
    ): JsonResponse {
        $meta = [
            'count' => is_array($collection) ? count($collection) : $collection->count(),
        ];

        if ($message) {
            $meta['message'] = $message;
        }

        if ($additionalMeta) {
            $meta = array_merge($meta, $additionalMeta);
        }

        return self::send($collection, $meta);
    }

    /**
     * Respuesta con datos de un solo recurso
     */
    public static function resource(
        mixed $resource,
        string $message = null,
        ?array $meta = null
    ): JsonResponse {
        if ($message) {
            $meta = array_merge($meta ?? [], ['message' => $message]);
        }

        return self::send($resource, $meta);
    }

    /**
     * Respuesta de confirmación de acción
     */
    public static function confirmed(
        string $action,
        mixed $data = null
    ): JsonResponse {
        return self::send($data, ['message' => "Action '{$action}' completed successfully"]);
    }

    /**
     * Respuesta con información de estado del sistema
     */
    public static function status(
        string $service,
        string $status,
        ?array $details = null
    ): JsonResponse {
        $response = [
            'service' => $service,
            'status' => $status,
            'checked_at' => now()->toISOString(),
        ];

        if ($details) {
            $response['details'] = $details;
        }

        return self::send($response);
    }
}