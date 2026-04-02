<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Admin\Settings;

use App\Http\Requests\Api\BaseApiFormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

final class StoreCompanyTypeRequest extends BaseApiFormRequest
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
            'name' => ['required', 'array', 'required_array_keys:ar,en'],
            'name.ar' => ['required', 'string'],
            'name.en' => ['required', 'string'],
            // 'slug' => ['required', 'string', 'unique:company_types,slug'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'name.array' => 'Name must be an array',
            'name.required_array_keys' => 'Name must have ar and en keys',
            'name.ar.required' => 'Arabic name is required',
            'name.en.required' => 'English name is required',
            'slug.required' => 'Slug is required',
            'slug.string' => 'Slug must be a string',
            'slug.unique' => 'Slug already exists',
        ];
    }
}
