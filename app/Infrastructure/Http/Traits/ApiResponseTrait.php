<?php

namespace App\Infrastructure\Http\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Throwable;

/**
 * Trait para manejar respuestas API de manera consistente y compatible con IConfigType
 */
trait ApiResponseTrait
{
    /**
     * Respuesta exitosa estándar
     */
    protected function successResponse(
        $data = null,
        string $message = 'Operación exitosa',
        int $code = 200,
        array $meta = []
    ): JsonResponse {
        $response = [
            'data' => $this->formatData($data),
            'status' => $code,
            // 'code_status' => $code,
            'message' => $message,
            'statusText' => $this->getStatusMessage($code),
            'metadata' => array_merge([
                'timestamp' => now()->toISOString(),
                'retryCount' => 0,
                'cached' => false
            ], $meta)
        ];

        return response()->json($response, $code);
    }

    /**
     * Respuesta de error estándar
     */
    protected function errorResponse(
        string $message = 'Error en la operación',
        int $code = 400,
        $data = null,
        array $errors = [],
        array $meta = []
    ): JsonResponse {
        $response = [
            'data' => $data ?? [],
            'status' => 'error',
            'code_status' => $code,
            'message' => $message,
            'statusText' => $this->getStatusMessage($code),
            'errors' => $errors,
            'metadata' => array_merge([
                'timestamp' => now()->toISOString(),
                'retryCount' => 0,
                'cached' => false
            ], $meta)
        ];

        return response()->json($response, $code);
    }

    /**
     * Respuesta para datos paginados
     */
    protected function paginatedResponse(
        LengthAwarePaginator $paginator,
        string $message = 'Datos obtenidos exitosamente',
        int $code = 200
    ): JsonResponse {
        $meta = [
            'pagination' => [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'from' => $paginator->firstItem(),
                'to' => $paginator->lastItem(),
                'has_more_pages' => $paginator->hasMorePages()
            ]
        ];

        return $this->successResponse(
            $paginator->items(),
            $message,
            $code,
            $meta
        );
    }

    /**
     * Respuesta para colección de recursos
     */
    protected function collectionResponse(
        AnonymousResourceCollection $collection,
        string $message = 'Datos obtenidos exitosamente',
        int $code = 200,
        array $meta = []
    ): JsonResponse {
        return $this->successResponse(
            $collection->resolve(),
            $message,
            $code,
            $meta
        );
    }

    /**
     * Respuesta para recurso único
     */
    protected function resourceResponse(
        JsonResource $resource,
        string $message = 'Recurso obtenido exitosamente',
        int $code = 200,
        array $meta = []
    ): JsonResponse {
        return $this->successResponse(
            $resource->resolve(),
            $message,
            $code,
            $meta
        );
    }

    /**
     * Respuesta de validación fallida
     */
    protected function validationErrorResponse(
        array $errors,
        string $message = 'Los datos proporcionados no son válidos'
    ): JsonResponse {
        return $this->errorResponse($message, 422, null, $errors);
    }

    /**
     * Respuesta de no encontrado
     */
    protected function notFoundResponse(string $message = 'Recurso no encontrado'): JsonResponse
    {
        return $this->errorResponse($message, 404);
    }

    /**
     * Respuesta de no autorizado
     */
    protected function unauthorizedResponse(string $message = 'No autorizado'): JsonResponse
    {
        return $this->errorResponse($message, 401);
    }

    /**
     * Respuesta de prohibido
     */
    protected function forbiddenResponse(string $message = 'Acceso prohibido'): JsonResponse
    {
        return $this->errorResponse($message, 403);
    }

    /**
     * Respuesta de error del servidor
     */
    protected function serverErrorResponse(
        Throwable $exception = null,
        string $message = 'Error interno del servidor'
    ): JsonResponse {
        $response = $this->errorResponse($message, 500);

        if (app()->environment('local', 'development') && $exception) {
            $responseData = $response->getData(true);
            $responseData['metadata']['debug'] = [
                'exception' => get_class($exception),
                'message' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTraceAsString()
            ];
            $response->setData($responseData);
        }

        return $response;
    }

    /**
     * Manejo de excepciones con respuesta apropiada
     */
    protected function handleException(Throwable $exception): JsonResponse
    {
        logger()->error('API Error: ' . $exception->getMessage(), [
            'exception' => $exception,
            'request' => request()->all(),
            'url' => request()->url(),
            'method' => request()->method(),
            // 'user_id' => auth()->id() ?? null
        ]);

        $exceptionMap = [
            'Illuminate\Database\Eloquent\ModelNotFoundException' => [404, 'Recurso no encontrado'],
            'Illuminate\Validation\ValidationException' => [422, 'Datos de validación incorrectos'],
            'Illuminate\Auth\AuthenticationException' => [401, 'No autenticado'],
            'Illuminate\Auth\Access\AuthorizationException' => [403, 'No autorizado'],
            'Symfony\Component\HttpKernel\Exception\NotFoundHttpException' => [404, 'Ruta no encontrada'],
            'Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException' => [405, 'Método no permitido']
        ];

        $exceptionClass = get_class($exception);

        if (isset($exceptionMap[$exceptionClass])) {
            [$code, $message] = $exceptionMap[$exceptionClass];
            return $this->errorResponse($message, $code);
        }

        return $this->serverErrorResponse($exception);
    }

    /**
     * Formatear datos para la respuesta
     */
    private function formatData($data)
    {
        if ($data instanceof JsonResource) return $data->resolve();
        if ($data instanceof AnonymousResourceCollection) return $data->resolve();
        if ($data instanceof Collection) return $data->toArray();
        if ($data instanceof LengthAwarePaginator) return $data->items();
        return $data;
    }

    /**
     * Obtener mensaje descriptivo del código de estado
     */
    private function getStatusMessage(int $code): string
    {
        $messages = [
            200 => 'éxito en la solicitud y la respuesta contiene la información solicitada.',
            201 => 'éxito en la creación de un nuevo recurso.',
            202 => 'la solicitud ha sido aceptada para procesamiento, pero no ha sido completada.',
            204 => 'éxito en la solicitud, pero la respuesta no contiene contenido.',
            400 => 'la solicitud es incorrecta o no se pudo entender por el servidor.',
            401 => 'la autenticación es requerida y ha fallado o aún no se ha proporcionado.',
            403 => 'la solicitud se entiende, pero se niega la acción porque no se tienen permisos suficientes.',
            404 => 'el recurso solicitado no se pudo encontrar en el servidor.',
            405 => 'el método de la solicitud no está permitido para el recurso solicitado.',
            409 => 'la solicitud no pudo ser procesada debido a un conflicto con el estado actual del recurso.',
            422 => 'la solicitud está bien formada pero contiene errores semánticos.',
            429 => 'el usuario ha enviado demasiadas solicitudes en un período de tiempo determinado.',
            500 => 'el servidor encontró una condición inesperada que impidió que se pudiera completar la solicitud.',
            502 => 'el servidor, actuando como gateway o proxy, recibió una respuesta inválida del servidor upstream.',
            503 => 'el servidor no está disponible temporalmente, generalmente debido a mantenimiento o sobrecarga.',
            504 => 'el servidor, actuando como gateway o proxy, no recibió una respuesta a tiempo del servidor upstream.'
        ];

        return $messages[$code] ?? 'Estado HTTP desconocido';
    }
}
