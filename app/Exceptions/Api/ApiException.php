<?php

namespace App\Exceptions\Api;

use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiException extends HttpResponseException
{
    public function __construct(string $massage = "", int $code = 500, $errors = [] )
    {
        $response = [
         'massage' => $massage,
         'code' => $code
        ];

        if (count($errors)){
            $response['errors'] = $errors;
        }

        parent::__construct(response()->json($response)->setStatusCode($code, $massage));
    }
}
