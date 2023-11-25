<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:customers,email',
            'phone'        => 'required|string|max:20',
            'birthdate'    => 'required|date',
            'address'      => 'required|string|max:255',
            'complement'   => 'nullable|string|max:255',
            'neighborhood' => 'required|string|max:255',
            'zip_code'     => 'required|string|max:15',
        ];
    }
}
