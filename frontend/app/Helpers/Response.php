<?php

namespace App\Helpers;

class Response
{
    /**
     * Return success response
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($message, $data = [], $status = 200)
    {
        return response()->json(
            [
                'message' => $message,
                'data'    => $data,
                'status'  => $status
            ],
            $status
        );
    }

    /**
     * Return error response
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function error($message, $errors = [], $status = 400)
    {
        return response()->json(
            [
                'message' => $message,
                'status'  => $status,
                'errors'  => $errors,
            ],
            $status
        );
    }

    /**
     * Return unauthorized error response
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function unauthorized($message = "Unauthorized", $code = 401)
    {
        return response()->json(
            [
                'message' => $message,
                'status'  => $code,
            ],
            401
        );
    }

    /**
     * Return json response
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function json($data = [], $status = 200)
    {
        return response()->json(
            [
                'data'    => $data,
                'status'  => $status
            ],
            $status
        );
    }
}