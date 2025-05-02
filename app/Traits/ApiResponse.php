<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    public function successResponse($status = null, $message = null): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => __($message),
        ], 200);
    }

    public function errorResponse($status = null, $message = null): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => __($message),
        ], 401);
    }
}
