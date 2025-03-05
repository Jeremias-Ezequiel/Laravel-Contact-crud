<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class ApiFormRequest extends FormRequest
{    
    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            "message" => "validation errors",
            "error" => $validator->errors()
        ],Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
