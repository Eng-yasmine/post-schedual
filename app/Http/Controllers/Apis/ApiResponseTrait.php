<?php

// app/Traits/ApiResponseTrait.php

namespace App\Http\Controllers\Apis\Traits;

trait ApiResponseTrait
{

    protected function successResponse($data = [], $message = '', $code = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }


    protected function errorResponse($message = '', $code = 400, $errors = [])
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }
}















?>
