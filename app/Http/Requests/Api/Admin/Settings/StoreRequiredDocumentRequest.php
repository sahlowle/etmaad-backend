<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Admin\Settings;

use App\Enums\RequiredDocumentTypeEnum;
use App\Http\Requests\Api\BaseApiFormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

final class StoreRequiredDocumentRequest extends BaseApiFormRequest
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
            'file_name' => ['required', 'array', 'required_array_keys:ar,en'],
            'file_name.ar' => ['required', 'string'],
            'file_name.en' => ['required', 'string'],
            'type' => ['required', 'string', Rule::in(RequiredDocumentTypeEnum::values())],
            'is_required' => ['required', 'in:0,1'],
        ];
    }

    public function messages(): array
    {
        return [
            'file_name.required' => 'File name is required',
            'file_name.array' => 'File name must be an array',
            'file_name.required_array_keys' => 'File name must have ar and en keys',
            'file_name.ar.required' => 'Arabic file name is required',
            'file_name.en.required' => 'English file name is required',
            'type.required' => 'Type is required',
            'type.string' => 'Type must be a string',
            'type.in' => 'Type must be one of the following: '.implode(', ', RequiredDocumentTypeEnum::values()),
        ];
    }
}
