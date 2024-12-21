<?php
namespace App\Helpers;

use Symfony\Component\HttpFoundation\Response;

class ApiResponse
{
    public static function sendSuccess($data, $statusCode = 200)
    {
        return response()->json([...$data], $statusCode);
    }

    public static function sendError($msg, $statusCode = 400)
    {
        return response()->json(['message' => $msg],  $statusCode);
    }
}
