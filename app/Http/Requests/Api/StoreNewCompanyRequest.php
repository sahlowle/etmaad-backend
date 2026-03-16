<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreNewCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user' => ['required', 'array'],
            'user.name' => ['required', 'string', 'max:255'],
            'user.username' => ['required', 'string', 'max:255', 'unique:users'],
            'user.email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'user.phone' => ['required', 'string', 'max:255', 'unique:users'],
            'user.password' => ['required', 'string', 'min:8', 'confirmed'],
            'company' => ['required', 'array'],
            'company.name' => ['required', 'string', 'max:255'],
            'company.email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'company.commercial_registration_number' => ['required', 'string', 'max:255', 'unique:companies'],
            'company.phone' => ['required', 'string', 'max:255', 'unique:users'],
            'company.logo' => ['nullable', 'string', 'max:255'],
            'company.website' => ['nullable', 'string', 'max:100'],
            'company.address' => ['nullable', 'string', 'max:255'],
        ];
    }
}
