<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Admin;

use App\Http\Requests\Api\BaseApiFormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

final class StoreFinancialEvaluationRequest extends BaseApiFormRequest
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
            'fin_level_1_score' => ['required', 'integer', 'min:0', 'max:100'],
            'fin_level_2_score' => ['required', 'integer', 'min:0', 'max:100'],
            'fin_level_3_score' => ['required', 'integer', 'min:0', 'max:100'],
            'financial_total_score' => ['required', 'integer', 'min:0', 'max:100'],
        ];
    }
}
