<?php

namespace App\Http;


trait ResponseForApi
{
    public function json ($data, $status = 200, $headers = [])
    {
        return response()->json([ 'data' => $data ], $status, $headers, 0);
    }
}