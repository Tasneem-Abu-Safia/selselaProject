<?php
namespace App\Http\Traits;

trait apiTrait{

    public function apiResponse($data, $msg, $status)
    {

        return response()->json([
            'status' => $status,
            'response_message' => $msg,
            'data' => $data,
        ], 200);
    }
}
