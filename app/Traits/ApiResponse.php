<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponse
{
    /**
     * Return a success response.
     *
     * @param  mixed  $data
     * @return JsonResponse
     */
    public function successResponse(string $message = '', $data = null, int $statusCode = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message ?: api_trans('success'),
            'data' => $data,
        ], $statusCode);
    }

    /**
     * Return an error response.
     *
     * @param  mixed  $errors
     * @return JsonResponse
     */
    public function errorResponse(string $message = 'Operation failed', int $statusCode = 400, $errors = null)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if ($errors !== null) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Return a validation error response.
     *
     * @param  mixed  $errors
     * @return JsonResponse
     */
    public function validationErrorResponse($errors, string $message = 'Validation failed')
    {
        return $this->errorResponse($message, 422, $errors);
    }

    /**
     * Return a not found error response.
     *
     * @return JsonResponse
     */
    public function notFoundResponse(string $message = 'Resource not found')
    {
        return $this->errorResponse($message, 404);
    }

    /**
     * Return an unauthorized error response.
     *
     * @return JsonResponse
     */
    public function unauthorizedResponse(string $message = 'Unauthorized')
    {
        return $this->errorResponse($message, 401);
    }

    /**
     * Return a forbidden error response.
     *
     * @return JsonResponse
     */
    public function forbiddenResponse(string $message = 'Forbidden')
    {
        return $this->errorResponse($message, 403);
    }

    /**
     * Return a created response.
     *
     * @param  mixed  $data
     * @return JsonResponse
     */
    public function createdResponse($data = null, string $message = '')
    {
        return $this->successResponse($message, $data, 201);
    }

    /**
     * Return a no content response.
     *
     * @return Response
     */
    public function noContentResponse()
    {
        return response()->noContent();
    }

    /**
     * Return a paginated response.
     *
     * @param  LengthAwarePaginator  $paginator
     * @return JsonResponse
     */
    public function paginatedResponse($paginator, string $message = '')
    {
        return response()->json([
            'success' => true,
            'message' => $message ?: api_trans('success'),
            'data' => $paginator->items(),
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
            ],
            'links' => [
                'first' => $paginator->url(1),
                'last' => $paginator->url($paginator->lastPage()),
                'prev' => $paginator->previousPageUrl(),
                'next' => $paginator->nextPageUrl(),
            ],
        ], 200);
    }
}
