<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VaccineRegistrationRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'gender' => 'required',
            'date_of_birth' => 'required',
            'nid' => 'string|numeric|unique:users,nid',
            'address' => 'string',
            'vaccine_center_id' => 'required',
        ];
    }
}
