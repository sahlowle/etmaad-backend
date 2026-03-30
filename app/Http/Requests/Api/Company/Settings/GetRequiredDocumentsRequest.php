<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Company\Settings;

use App\Enums\RequiredDocumentTypeEnum;
use App\Http\Requests\Api\BaseApiFormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

final class GetRequiredDocumentsRequest extends BaseApiFormRequest
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
            'type' => ['required', 'string', Rule::in(RequiredDocumentTypeEnum::values())],
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => 'Type is required',
            'type.in' => 'Type must be one of the following: '.implode(', ', RequiredDocumentTypeEnum::values()),
        ];
    }
}
