<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rules\Password;

class StoreNewCompanyRequest extends BaseApiFormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user' => ['required', 'array'],
            'user.name' => ['required', 'string', 'max:255'],
            'user.username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'user.email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'user.phone' => ['required', 'string', 'max:255', 'unique:users,phone'],
            'user.password' => [
                'required',
                'string',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols(),
            ],
            // company
            'company' => ['required', 'array'],
            'company.name' => ['required', 'string', 'max:255'],
            'company.email' => ['required', 'string', 'email', 'max:255', 'unique:companies,email'],
            'company.commercial_registration_number' => ['required', 'string', 'max:255', 'unique:companies,commercial_registration_number'],
            'company.phone' => ['required', 'string', 'max:255', 'unique:companies,phone'],
            'company.logo' => ['nullable', 'string', 'max:255'],
            'company.website' => ['nullable', 'string', 'max:100', 'ur;'],
            'company.address' => ['nullable', 'string', 'max:255'],
        ];
    }
}
