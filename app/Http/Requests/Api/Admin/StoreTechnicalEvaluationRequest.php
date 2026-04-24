<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Admin;

use App\Http\Requests\Api\BaseApiFormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

final class StoreTechnicalEvaluationRequest extends BaseApiFormRequest
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
            'tech_level_1_score' => ['required', 'integer', 'min:0', 'max:100'],
            'tech_level_2_score' => ['required', 'integer', 'min:0', 'max:100'],
            'tech_level_3_score' => ['required', 'integer', 'min:0', 'max:100'],
            'technical_total_score' => ['required', 'integer', 'min:0', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'tech_level_1_score.required' => 'Tech level 1 score is required',
            'tech_level_2_score.required' => 'Tech level 2 score is required',
            'tech_level_3_score.required' => 'Tech level 3 score is required',
            'technical_total_score.required' => 'Technical total score is required',
        ];
    }
}
