<?php

namespace App\Http\Requests;

class ContactUpdateRequest extends ApiFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "min:8",
            "email" => "email|unique:contacts",
            "phone" => "min:8",
            "address" => "min:8"
        ];
    }
}
