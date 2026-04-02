<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Admin\Settings;

use App\Http\Requests\Api\BaseApiFormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

final class UpdateNationalityRequest extends BaseApiFormRequest
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
            'name' => ['sometimes', 'array', 'required_array_keys:ar,en'],
            'name.ar' => ['sometimes', 'string'],
            'name.en' => ['sometimes', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.array' => 'Name must be an array',
            'name.required_array_keys' => 'Name must have ar and en keys',
            'name.ar.string' => 'Arabic name must be a string',
            'name.en.string' => 'English name must be a string',
        ];
    }
}
