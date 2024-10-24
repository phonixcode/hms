<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait HandlesRepositoryActionsTrait
{
    use ApiResponseTrait;

    /**
     * Handle the creation of a resource.
     * 
     * @param callable $createAction
     * @param string $message
     * @return JsonResponse
     */
    protected function handleCreate(callable $createAction, string $message): JsonResponse
    {
        try {
            $resource = $createAction();
            return $this->successResponse($resource, $message, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to create resource');
        }
    }

    /**
     * Handle the update of a resource.
     * 
     * @param callable $updateAction
     * @param string $message
     * @return JsonResponse
     */
    protected function handleUpdate(callable $updateAction, string $message): JsonResponse
    {
        try {
            $resource = $updateAction();
            return $this->successResponse($resource, $message);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to update resource');
        }
    }

    /**
     * Handle the deletion of a resource.
     * 
     * @param callable $deleteAction
     * @param string $message
     * @return JsonResponse
     */
    protected function handleDelete(callable $deleteAction, string $message): JsonResponse
    {
        try {
            $deleteAction();
            return $this->successResponse(null, $message);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to delete resource');
        }
    }
}
