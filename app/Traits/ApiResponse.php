<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    public function successResponse( $message = null): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => __($message),
        ], 200);
    }

    public function errorResponse( $message = null): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => __($message),
        ], 401);
    }
}
