<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Admin;

use App\Enums\CompanyStatusesEnum;
use App\Http\Requests\Api\BaseApiFormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

final class ChangeCompanyStatusRequest extends BaseApiFormRequest
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
            'status' => ['required', Rule::in(CompanyStatusesEnum::values())],
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'Status is required',
            'status.in' => 'Status must be one of: '.implode(', ', CompanyStatusesEnum::values()),
        ];
    }
}
