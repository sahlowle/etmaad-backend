<?php

declare(strict_types=1);

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

final class SubmitBidRequest extends BaseApiFormRequest
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
            'technical_envelope_file' => [
                'required',
                Rule::file()->types(['pdf'])->max(2048),
            ],
            // 'guarantee_type' => ['required', Rule::enum(TenderBidStatusesEnum::class)],
            'guarantee_number' => ['required', 'string', 'max:255'],
            'guarantee_bank' => ['required', 'string', 'max:255'],
            'guarantee_amount' => ['required', 'numeric', 'min:0'],
            'guarantee_expiry' => ['required', 'date'],
            'guarantee_file' => [
                'required',
                Rule::file()->types(['pdf'])->max(2048),
            ],

            'items' => ['required', 'array'],
            'items.*.tender_boq_id' => [
                'required',
                'distinct',
                Rule::exists('tender_boqs', 'id')->where('tender_id', $this->route('tender')->id),
            ],
            'items.*.unit_price' => ['required', 'numeric', 'min:1'],
        ];
    }
}
