<?php

namespace App\Http\Controllers\Base;

use Illuminate\Routing\Controller as LaravelController;

class Controller extends LaravelController
{
    protected function success($message = 'Success', $data = null)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data
        ]);
    }

    protected function error($message = 'Error', $code = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $code);
    }
}
