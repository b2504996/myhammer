<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 08.08.2018
 * Time: 21:06
 */

namespace App;


class ApiResponse
{
    public static function success($key, $value)
    {
        return response()->json([
            'success' => true,
            $key => $value
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public static function successful()
    {
        return response()->json([
            'success' => true,
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public static function errors($errors)
    {
        return response()->json([
            'success' => false,
            'errors' => $errors
        ], 400, [], JSON_UNESCAPED_UNICODE);
    }
}