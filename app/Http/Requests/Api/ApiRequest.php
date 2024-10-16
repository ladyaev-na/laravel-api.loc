<?php

namespace App\Http\Requests\Api;

use App\Exceptions\Api\ApiException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ApiRequest extends FormRequest
{
    public function failedValidation(Validator $validator)
    {
        throw new ApiException('Unprocessable Entity', 422, $validator->errors());
    }
}
